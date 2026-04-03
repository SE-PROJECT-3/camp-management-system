@extends('layouts.admin')

@section('title', 'Reports & Analytics')

@section('content')
<div class="space-y-8">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Reports & Analytics</h1>
            <p class="text-sm text-slate-500 mt-1">Generate summary reports and visual analytics for camps</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('reports.attendance') }}"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 dark:bg-zinc-800 text-slate-700 dark:text-slate-300 text-sm font-medium hover:bg-slate-200 dark:hover:bg-zinc-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Attendance Stats
            </a>
        </div>
    </div>

    {{-- Validation Errors --}}
    @if(!empty($errors))
        <div class="p-4 bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 rounded-xl flex items-start gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-red-500 shrink-0 mt-0.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12" y2="16"/></svg>
            <div>
                @foreach($errors as $error)
                    <p class="text-sm text-red-600 dark:text-red-400 font-medium">{{ $error }}</p>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Filters --}}
    <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-slate-200 dark:border-zinc-800 p-6">
        <h2 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-4">Filter Report</h2>
        <form method="GET" action="{{ route('reports.index') }}" id="filter-form" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[180px]">
                <label class="block text-xs font-medium text-slate-600 dark:text-slate-400 mb-1">Camp</label>
                <select name="camp_id" id="camp_id"
                    class="w-full rounded-xl border border-slate-200 dark:border-zinc-700 bg-slate-50 dark:bg-zinc-800 px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="">All Camps</option>
                    @foreach($camps as $camp)
                        <option value="{{ $camp->id }}" {{ $campId == $camp->id ? 'selected' : '' }}>
                            {{ $camp->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1 min-w-[160px]">
                <label class="block text-xs font-medium text-slate-600 dark:text-slate-400 mb-1">Date From</label>
                <input type="date" name="date_from" value="{{ $dateFrom }}"
                    class="w-full rounded-xl border border-slate-200 dark:border-zinc-700 bg-slate-50 dark:bg-zinc-800 px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
            <div class="flex-1 min-w-[160px]">
                <label class="block text-xs font-medium text-slate-600 dark:text-slate-400 mb-1">Date To</label>
                <input type="date" name="date_to" value="{{ $dateTo }}"
                    class="w-full rounded-xl border border-slate-200 dark:border-zinc-700 bg-slate-50 dark:bg-zinc-800 px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
            <div class="flex gap-2">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold transition shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    Apply
                </button>
                <a href="{{ route('reports.index') }}"
                   class="inline-flex items-center px-4 py-2 rounded-xl border border-slate-200 dark:border-zinc-700 text-sm font-medium text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-zinc-800 transition">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-slate-200 dark:border-zinc-800 p-5">
            <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Total Camps</p>
            <p class="text-3xl font-bold text-indigo-600 mt-1">{{ $camps->count() }}</p>
        </div>
        <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-slate-200 dark:border-zinc-800 p-5">
            <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Families</p>
            <p class="text-3xl font-bold text-emerald-600 mt-1">{{ number_format($totalFamilies) }}</p>
        </div>
        <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-slate-200 dark:border-zinc-800 p-5">
            <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Members</p>
            <p class="text-3xl font-bold text-blue-600 mt-1">{{ number_format($totalMembers) }}</p>
        </div>
        <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-slate-200 dark:border-zinc-800 p-5">
            <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Distributions</p>
            <p class="text-3xl font-bold text-violet-600 mt-1">{{ number_format($totalDistributions) }}</p>
        </div>
        <div class="col-span-2 lg:col-span-1 bg-white dark:bg-zinc-900 rounded-2xl border border-slate-200 dark:border-zinc-800 p-5">
            <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Received</p>
            <p class="text-3xl font-bold text-amber-500 mt-1">{{ number_format($receivedCount) }}</p>
            <p class="text-xs text-slate-400 mt-1">{{ $totalDistributions > 0 ? round(($receivedCount / $totalDistributions)*100,1) : 0 }}% rate</p>
        </div>
    </div>

    {{-- Charts Row --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Bar Chart: Families per Camp --}}
        <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-slate-200 dark:border-zinc-800 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-semibold text-slate-700 dark:text-slate-200">Families per Camp</h2>
                <span class="text-xs text-slate-400">Bar Chart</span>
            </div>
            <canvas id="familiesChart" height="220"></canvas>
        </div>

        {{-- Doughnut Chart: Priority Breakdown --}}
        <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-slate-200 dark:border-zinc-800 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-semibold text-slate-700 dark:text-slate-200">Families by Priority</h2>
                <span class="text-xs text-slate-400">Doughnut</span>
            </div>
            <canvas id="priorityChart" height="220"></canvas>
        </div>

        {{-- Line Chart: Distributions over Time --}}
        <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-slate-200 dark:border-zinc-800 p-6 lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-semibold text-slate-700 dark:text-slate-200">Distributions Over Time</h2>
                <span class="text-xs text-slate-400">Line Chart</span>
            </div>
            <canvas id="monthlyChart" height="100"></canvas>
        </div>

        {{-- Bar Chart: Occupancy Rate --}}
        <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-slate-200 dark:border-zinc-800 p-6 lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-semibold text-slate-700 dark:text-slate-200">Camp Occupancy Rate (%)</h2>
                <span class="text-xs text-slate-400">Horizontal Bar</span>
            </div>
            <canvas id="occupancyChart" height="80"></canvas>
        </div>
    </div>

    {{-- Camp Summary Table --}}
    <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-slate-200 dark:border-zinc-800 overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-slate-100 dark:border-zinc-800">
            <h2 class="font-semibold text-slate-700 dark:text-slate-200">Camp Summary Report</h2>
            <div class="flex gap-2">
                {{-- Export CSV (Excel) --}}
                <form method="GET" action="{{ route('reports.export-csv') }}">
                    <input type="hidden" name="camp_id" value="{{ $campId }}">
                    <input type="hidden" name="date_from" value="{{ $dateFrom }}">
                    <input type="hidden" name="date_to" value="{{ $dateTo }}">
                    <input type="hidden" name="format" value="csv">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold transition shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        Export CSV / Excel
                    </button>
                </form>

                {{-- Export PDF (print) --}}
                <a href="{{ route('reports.export-pdf', ['camp_id' => $campId, 'date_from' => $dateFrom, 'date_to' => $dateTo]) }}"
                   target="_blank"
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold transition shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                    Export PDF
                </a>
            </div>
        </div>

        @if($campStats->isEmpty())
            <div class="p-12 text-center text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-3 opacity-30"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                <p class="text-sm">No data available for the selected filters.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-zinc-800/50 text-xs text-slate-500 uppercase tracking-wider">
                            <th class="text-left px-6 py-3 font-semibold">Camp</th>
                            <th class="text-left px-6 py-3 font-semibold">Location</th>
                            <th class="text-right px-6 py-3 font-semibold">Capacity</th>
                            <th class="text-right px-6 py-3 font-semibold">Families</th>
                            <th class="text-right px-6 py-3 font-semibold">Members</th>
                            <th class="text-right px-6 py-3 font-semibold">Distributions</th>
                            <th class="text-right px-6 py-3 font-semibold">Received</th>
                            <th class="text-right px-6 py-3 font-semibold">Occupancy</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-zinc-800">
                        @foreach($campStats as $stat)
                        <tr class="hover:bg-slate-50 dark:hover:bg-zinc-800/30 transition">
                            <td class="px-6 py-4 font-medium text-slate-800 dark:text-slate-200">{{ $stat['name'] }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $stat['location'] }}</td>
                            <td class="px-6 py-4 text-right text-slate-600 dark:text-slate-400">{{ number_format($stat['capacity']) }}</td>
                            <td class="px-6 py-4 text-right font-semibold text-emerald-600">{{ number_format($stat['families_count']) }}</td>
                            <td class="px-6 py-4 text-right text-blue-600 font-semibold">{{ number_format($stat['members_count']) }}</td>
                            <td class="px-6 py-4 text-right text-violet-600">{{ number_format($stat['distributions_count']) }}</td>
                            <td class="px-6 py-4 text-right text-amber-600">{{ number_format($stat['received_count']) }}</td>
                            <td class="px-6 py-4 text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                    {{ $stat['occupancy_rate'] >= 90 ? 'bg-red-100 text-red-700' : ($stat['occupancy_rate'] >= 70 ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700') }}">
                                    {{ $stat['occupancy_rate'] }}%
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const campNames    = @json($campStats->pluck('name'));
    const campFamilies = @json($campStats->pluck('families_count'));
    const campOccupancy= @json($campStats->pluck('occupancy_rate'));

    const priorityLabels = @json($priorityStats->pluck('priority'));
    const priorityCounts = @json($priorityStats->pluck('count'));

    const monthLabels = @json($monthlyDistributions->pluck('month'));
    const monthTotals = @json($monthlyDistributions->pluck('total'));

    const palette = ['#6366f1','#10b981','#3b82f6','#f59e0b','#ef4444','#8b5cf6','#06b6d4','#f97316'];

    // --- Families per Camp (Bar) ---
    new Chart(document.getElementById('familiesChart'), {
        type: 'bar',
        data: {
            labels: campNames,
            datasets: [{
                label: 'Families',
                data: campFamilies,
                backgroundColor: palette,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, grid: { color: '#f1f5f9' } } }
        }
    });

    // --- Priority Doughnut ---
    new Chart(document.getElementById('priorityChart'), {
        type: 'doughnut',
        data: {
            labels: priorityLabels.length ? priorityLabels : ['No Data'],
            datasets: [{
                data: priorityCounts.length ? priorityCounts : [1],
                backgroundColor: palette,
                borderWidth: 0,
                hoverOffset: 8,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'right' } },
            cutout: '65%',
        }
    });

    // --- Distributions over Time (Line) ---
    new Chart(document.getElementById('monthlyChart'), {
        type: 'line',
        data: {
            labels: monthLabels.length ? monthLabels : ['No Data'],
            datasets: [{
                label: 'Distributions',
                data: monthTotals.length ? monthTotals : [0],
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99,102,241,0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#6366f1',
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // --- Occupancy Rate (Horizontal Bar) ---
    new Chart(document.getElementById('occupancyChart'), {
        type: 'bar',
        data: {
            labels: campNames,
            datasets: [{
                label: 'Occupancy %',
                data: campOccupancy,
                backgroundColor: campOccupancy.map(v => v >= 90 ? '#ef4444' : v >= 70 ? '#f59e0b' : '#10b981'),
                borderRadius: 6,
                borderSkipped: false,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { x: { beginAtZero: true, max: 100 } }
        }
    });

});
</script>
@endsection
