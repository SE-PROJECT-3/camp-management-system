<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Camp;
use App\Models\Family;
use App\Models\Distribution;

class ReportController extends Controller
{
    /**
     * Show the main reports dashboard with summary + charts.
     */
    public function index(Request $request)
    {
        $camps = Camp::all();

        // Filters
        $campId    = $request->input('camp_id');
        $dateFrom  = $request->input('date_from');
        $dateTo    = $request->input('date_to');

        // Validate date range
        $errors = [];
        if ($dateFrom && $dateTo && $dateFrom > $dateTo) {
            $errors[] = 'Start date cannot be after end date.';
        }

        // ---------- Summary stats ----------
        $familiesQuery      = Family::query();
        $distributionsQuery = Distribution::query();

        if ($campId) {
            $familiesQuery->where('camp_id', $campId);
            $distributionsQuery->whereHas('family', fn($q) => $q->where('camp_id', $campId));
        }
        if ($dateFrom) {
            $distributionsQuery->whereDate('distributed_at', '>=', $dateFrom);
        }
        if ($dateTo) {
            $distributionsQuery->whereDate('distributed_at', '<=', $dateTo);
        }

        $totalFamilies     = $familiesQuery->count();
        $totalMembers      = $familiesQuery->sum('members_count');
        $totalDistributions = $distributionsQuery->count();
        $receivedCount     = (clone $distributionsQuery)->where('received', true)->count();
        $pendingCount      = $totalDistributions - $receivedCount;

        // ---------- Attendance/families per camp (for charts & table) ----------
        /** @var \Illuminate\Database\Eloquent\Collection<int, Camp> $allCamps */
        $allCamps  = Camp::withCount('families')->get();
        $campStats = $allCamps->map(function (Camp $camp) use ($dateFrom, $dateTo) {
            $membersTotal = $camp->families()->sum('members_count');
            $distQuery = Distribution::whereHas('family', fn($q) => $q->where('camp_id', $camp->id));
            if ($dateFrom) $distQuery->whereDate('distributed_at', '>=', $dateFrom);
            if ($dateTo)   $distQuery->whereDate('distributed_at', '<=', $dateTo);

            return [
                'id'                  => $camp->id,
                'name'                => $camp->name,
                'location'            => $camp->location,
                'capacity'            => $camp->capacity,
                'families_count'      => $camp->families_count,
                'members_count'       => $membersTotal,
                'distributions_count' => $distQuery->count(),
                'received_count'      => (clone $distQuery)->where('received', true)->count(),
                'occupancy_rate'      => $camp->capacity > 0
                    ? round(($camp->families_count / $camp->capacity) * 100, 1)
                    : 0,
            ];
        });

        // ---------- Distributions by month (for line chart) — MySQL DATE_FORMAT ----------
        $monthlyDistributions = Distribution::selectRaw(
                "DATE_FORMAT(distributed_at, '%Y-%m') as month, COUNT(*) as total"
            )
            ->whereNotNull('distributed_at')
            ->when($campId, fn($q) => $q->whereHas('family', fn($q2) => $q2->where('camp_id', $campId)))
            ->when($dateFrom, fn($q) => $q->whereDate('distributed_at', '>=', $dateFrom))
            ->when($dateTo,   fn($q) => $q->whereDate('distributed_at', '<=', $dateTo))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // ---------- Priority breakdown ----------
        $priorityStats = Family::selectRaw('priority, COUNT(*) as count')
            ->when($campId, fn($q) => $q->where('camp_id', $campId))
            ->groupBy('priority')
            ->get();

        return view('reports.index', compact(
            'camps', 'campId', 'dateFrom', 'dateTo',
            'totalFamilies', 'totalMembers', 'totalDistributions',
            'receivedCount', 'pendingCount',
            'campStats', 'monthlyDistributions', 'priorityStats',
            'errors'
        ));
    }

    /**
     * Export data as CSV (opens in Excel/Numbers).
     */
    public function exportCsv(Request $request)
    {
        $format = $request->input('format', 'csv');

        // Validate format
        if (!in_array($format, ['csv', 'excel'])) {
            return back()->withErrors(['format' => 'Invalid export format. Use csv or excel.']);
        }

        $campId   = $request->input('camp_id');
        $dateFrom = $request->input('date_from');
        $dateTo   = $request->input('date_to');

        // Validate dates
        if ($dateFrom && $dateTo && $dateFrom > $dateTo) {
            return back()->withErrors(['date' => 'Start date cannot be after end date.']);
        }

        $query = Family::with('camp')
            ->when($campId, fn($q) => $q->where('camp_id', $campId));

        $families = $query->get();

        // Build CSV content
        $csvData = [];
        $csvData[] = ['Family Name', 'Camp', 'Location', 'Members Count', 'Category', 'Priority'];

        foreach ($families as $family) {
            $csvData[] = [
                $family->name,
                $family->camp?->name ?? 'N/A',
                $family->camp?->location ?? 'N/A',
                $family->members_count,
                $family->category ?? 'N/A',
                $family->priority ?? 'N/A',
            ];
        }

        // Add summary row
        $csvData[] = [];
        $csvData[] = ['--- SUMMARY ---'];
        $csvData[] = ['Total Families', $families->count()];
        $csvData[] = ['Total Members', $families->sum('members_count')];
        $csvData[] = ['Generated At', now()->format('Y-m-d H:i:s')];

        $filename = 'camp_report_' . now()->format('Ymd_His') . '.csv';

        $callback = function () use ($csvData) {
            $handle = fopen('php://output', 'w');
            // UTF-8 BOM for Excel compatibility
            fwrite($handle, "\xEF\xBB\xBF");
            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        };

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Return a printable HTML page (user can Ctrl+P → Save as PDF).
     */
    public function exportPdf(Request $request)
    {
        $campId   = $request->input('camp_id');
        $dateFrom = $request->input('date_from');
        $dateTo   = $request->input('date_to');

        // Validate dates
        if ($dateFrom && $dateTo && $dateFrom > $dateTo) {
            return back()->withErrors(['date' => 'Start date cannot be after end date.']);
        }

        $camps = Camp::withCount('families')->get();

        $familiesQuery      = Family::with('camp')->when($campId, fn($q) => $q->where('camp_id', $campId));
        $distributionsQuery = Distribution::with('family.camp')
            ->when($campId, fn($q) => $q->whereHas('family', fn($q2) => $q2->where('camp_id', $campId)))
            ->when($dateFrom, fn($q) => $q->whereDate('distributed_at', '>=', $dateFrom))
            ->when($dateTo,   fn($q) => $q->whereDate('distributed_at', '<=', $dateTo));

        $families      = $familiesQuery->get();
        $distributions = $distributionsQuery->get();

        $selectedCamp = $campId ? Camp::find($campId) : null;

        return view('reports.pdf', compact(
            'camps', 'families', 'distributions',
            'selectedCamp', 'dateFrom', 'dateTo',
            'campId'
        ));
    }

    /**
     * Attendance statistics page per camp.
     */
    public function attendance(Request $request)
    {
        $camps    = Camp::all();
        $campId   = $request->input('camp_id');
        $dateFrom = $request->input('date_from');
        $dateTo   = $request->input('date_to');
        $errors   = [];

        if ($dateFrom && $dateTo && $dateFrom > $dateTo) {
            $errors[] = 'Start date cannot be after end date.';
        }

        $attendanceStats = Camp::withCount('families')
            ->get()
            ->filter(fn($c) => !$campId || $c->id == $campId)
            ->map(function ($camp) use ($dateFrom, $dateTo) {
                $membersTotal = $camp->families()->sum('members_count');

                $distQuery = Distribution::whereHas('family', fn($q) => $q->where('camp_id', $camp->id));
                if ($dateFrom) $distQuery->whereDate('distributed_at', '>=', $dateFrom);
                if ($dateTo)   $distQuery->whereDate('distributed_at', '<=', $dateTo);

                $totalDist    = $distQuery->count();
                $receivedDist = (clone $distQuery)->where('received', true)->count();

                return [
                    'camp'               => $camp,
                    'families_count'     => $camp->families_count,
                    'members_count'      => $membersTotal,
                    'capacity'           => $camp->capacity,
                    'occupancy_pct'      => $camp->capacity > 0 ? round(($camp->families_count / $camp->capacity) * 100, 1) : 0,
                    'distributions'      => $totalDist,
                    'received'           => $receivedDist,
                    'pending'            => $totalDist - $receivedDist,
                    'receipt_rate'       => $totalDist > 0 ? round(($receivedDist / $totalDist) * 100, 1) : 0,
                ];
            })->values();

        return view('reports.attendance', compact(
            'camps', 'campId', 'dateFrom', 'dateTo',
            'attendanceStats', 'errors'
        ));
    }
}
