<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camp Management Report – {{ now()->format('Y-m-d') }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #1e293b;
            background: #fff;
            font-size: 13px;
            line-height: 1.5;
        }

        /* ── Print button (hidden when printing) ── */
        .print-controls {
            position: fixed; top: 16px; right: 16px;
            display: flex; gap: 10px;
            z-index: 999;
        }
        .btn-print {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 10px 22px;
            background: #4f46e5; color: #fff;
            border: none; border-radius: 10px;
            font-size: 14px; font-weight: 600; cursor: pointer;
            box-shadow: 0 4px 12px rgba(79,70,229,.3);
        }
        .btn-back {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 10px 22px;
            background: #f1f5f9; color: #475569;
            border: 1px solid #e2e8f0; border-radius: 10px;
            font-size: 14px; font-weight: 600; cursor: pointer;
            text-decoration: none;
        }

        /* ── Page Content ── */
        .page { max-width: 960px; margin: 0 auto; padding: 40px 30px; }

        /* Cover header */
        .report-header {
            display: flex; align-items: center; justify-content: space-between;
            padding-bottom: 24px;
            border-bottom: 2px solid #6366f1;
            margin-bottom: 32px;
        }
        .report-header .logo {
            width: 42px; height: 42px;
            background: #4f46e5; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
        }
        .report-header .logo svg { color: #fff; }
        .report-header .title { margin-left: 14px; }
        .report-header .title h1 { font-size: 22px; font-weight: 700; color: #1e293b; }
        .report-header .title p  { font-size: 12px; color: #94a3b8; margin-top: 2px; }
        .report-header .meta { text-align: right; font-size: 12px; color: #64748b; }
        .report-header .meta strong { display: block; font-size: 14px; color: #1e293b; }

        /* Section titles */
        .section-title {
            font-size: 11px; font-weight: 700;
            color: #6366f1; text-transform: uppercase; letter-spacing: .08em;
            margin-bottom: 12px; margin-top: 32px;
        }

        /* Summary cards */
        .cards { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 8px; }
        .card {
            background: #f8fafc; border: 1px solid #e2e8f0;
            border-radius: 12px; padding: 14px 16px;
        }
        .card .label { font-size: 10px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: .05em; }
        .card .value { font-size: 26px; font-weight: 700; margin-top: 4px; }
        .card.blue  .value { color: #3b82f6; }
        .card.green .value { color: #10b981; }
        .card.purple.value { color: #8b5cf6; }
        .card.amber .value { color: #f59e0b; }

        /* Table */
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        thead tr { background: #f1f5f9; }
        thead th {
            text-align: left; padding: 10px 12px;
            font-size: 10px; font-weight: 700;
            text-transform: uppercase; letter-spacing: .05em;
            color: #64748b;
        }
        thead th.right { text-align: right; }
        tbody tr { border-bottom: 1px solid #f1f5f9; }
        tbody tr:last-child { border-bottom: none; }
        tbody td { padding: 10px 12px; color: #334155; }
        tbody td.right { text-align: right; }
        tbody td.bold { font-weight: 600; }

        .badge {
            display: inline-block;
            padding: 2px 10px; border-radius: 99px;
            font-size: 10px; font-weight: 700;
        }
        .badge-green { background: #dcfce7; color: #166534; }
        .badge-amber { background: #fef9c3; color: #854d0e; }
        .badge-red   { background: #fee2e2; color: #991b1b; }

        /* Footer */
        .report-footer {
            margin-top: 40px; padding-top: 16px;
            border-top: 1px dashed #e2e8f0;
            font-size: 10px; color: #94a3b8;
            display: flex; justify-content: space-between;
        }

        /* Print overrides */
        @media print {
            .print-controls { display: none !important; }
            body { background: #fff; }
            .page { padding: 20px; }
            .cards { page-break-inside: avoid; }
            table { page-break-inside: auto; }
            tr { page-break-inside: avoid; }
        }
    </style>
</head>
<body>

    {{-- Controls --}}
    <div class="print-controls">
        <a href="{{ url()->previous() }}" class="btn-back">
            ← Back
        </a>
        <button class="btn-print" onclick="window.print()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
            Print / Save as PDF
        </button>
    </div>

    <div class="page">

        {{-- Header --}}
        <div class="report-header">
            <div style="display:flex;align-items:center;">
                <div class="logo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </div>
                <div class="title">
                    <h1>Camp Management System</h1>
                    <p>NGO / Organization Coordinator Report</p>
                </div>
            </div>
            <div class="meta">
                <strong>Generated: {{ now()->format('d M Y, H:i') }}</strong>
                @if($selectedCamp)
                    <span>Camp: {{ $selectedCamp->name }}</span><br>
                @else
                    <span>All Camps</span><br>
                @endif
                @if($dateFrom || $dateTo)
                    <span>Period: {{ $dateFrom ?: '—' }} → {{ $dateTo ?: '—' }}</span>
                @endif
            </div>
        </div>

        {{-- Summary Cards --}}
        <div class="section-title">Summary Overview</div>
        <div class="cards">
            <div class="card blue">
                <div class="label">Total Camps</div>
                <div class="value" style="color:#3b82f6">{{ $camps->count() }}</div>
            </div>
            <div class="card green">
                <div class="label">Families</div>
                <div class="value" style="color:#10b981">{{ number_format($families->count()) }}</div>
            </div>
            <div class="card">
                <div class="label">Members</div>
                <div class="value" style="color:#6366f1">{{ number_format($families->sum('members_count')) }}</div>
            </div>
            <div class="card amber">
                <div class="label">Distributions</div>
                <div class="value" style="color:#f59e0b">{{ number_format($distributions->count()) }}</div>
            </div>
        </div>

        {{-- Camps Table --}}
        <div class="section-title">Camps Overview</div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Camp Name</th>
                    <th>Location</th>
                    <th class="right">Capacity</th>
                    <th class="right">Families</th>
                    <th class="right">Occupancy</th>
                </tr>
            </thead>
            <tbody>
                @foreach($camps as $i => $camp)
                @php
                    $fCount = $camp->families_count;
                    $occ    = $camp->capacity > 0 ? round(($fCount / $camp->capacity) * 100, 1) : 0;
                    $badgeClass = $occ >= 90 ? 'badge-red' : ($occ >= 70 ? 'badge-amber' : 'badge-green');
                @endphp
                <tr>
                    <td style="color:#94a3b8">{{ $i + 1 }}</td>
                    <td class="bold">{{ $camp->name }}</td>
                    <td>{{ $camp->location }}</td>
                    <td class="right">{{ number_format($camp->capacity) }}</td>
                    <td class="right">{{ number_format($fCount) }}</td>
                    <td class="right"><span class="badge {{ $badgeClass }}">{{ $occ }}%</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Families Table --}}
        <div class="section-title" style="margin-top:36px;">Families Register</div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Family Name</th>
                    <th>Camp</th>
                    <th>Category</th>
                    <th>Priority</th>
                    <th class="right">Members</th>
                </tr>
            </thead>
            <tbody>
                @forelse($families as $i => $family)
                <tr>
                    <td style="color:#94a3b8">{{ $i + 1 }}</td>
                    <td class="bold">{{ $family->name }}</td>
                    <td>{{ $family->camp?->name ?? '—' }}</td>
                    <td>{{ $family->category ?? '—' }}</td>
                    <td>
                        @php $p = strtolower($family->priority ?? ''); @endphp
                        <span class="badge {{ $p === 'high' ? 'badge-red' : ($p === 'medium' ? 'badge-amber' : 'badge-green') }}">
                            {{ $family->priority ?? '—' }}
                        </span>
                    </td>
                    <td class="right">{{ number_format($family->members_count) }}</td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;color:#94a3b8;padding:20px">No families found.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{-- Distributions Table --}}
        @if($distributions->isNotEmpty())
        <div class="section-title" style="margin-top:36px;">Distributions</div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Family</th>
                    <th>Camp</th>
                    <th class="right">Qty</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($distributions as $i => $dist)
                <tr>
                    <td style="color:#94a3b8">{{ $i + 1 }}</td>
                    <td class="bold">{{ $dist->family?->name ?? '—' }}</td>
                    <td>{{ $dist->family?->camp?->name ?? '—' }}</td>
                    <td class="right">{{ $dist->quantity }}</td>
                    <td>
                        <span class="badge {{ $dist->received ? 'badge-green' : 'badge-amber' }}">
                            {{ $dist->received ? 'Received' : 'Pending' }}
                        </span>
                    </td>
                    <td>{{ $dist->distributed_at ? \Carbon\Carbon::parse($dist->distributed_at)->format('d M Y') : '—' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        {{-- Footer --}}
        <div class="report-footer">
            <span>Camp Management System — Confidential</span>
            <span>Generated on {{ now()->format('d M Y \a\t H:i') }}</span>
        </div>

    </div>

    <script>
        // Auto-trigger print dialog after a short delay so CSS loads
        // Comment this out if you don't want auto-print:
        // window.onload = () => setTimeout(() => window.print(), 800);
    </script>
</body>
</html>
