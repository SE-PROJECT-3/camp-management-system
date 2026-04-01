@extends('layouts.admin')

@section('title', 'Attendance Statistics')

@section('content')
<div class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Attendance Statistics</h1>
            <p class="text-sm text-slate-500 mt-1">View attendance and distribution stats per camp to plan services and aid distribution</p>
        </div>
        <a href="{{ route('reports.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 dark:bg-zinc-800 text-slate-700 dark:text-slate-300 text-sm font-medium hover:bg-slate-200 dark:hover:bg-zinc-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Back to Reports
        </a>
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
        <h2 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-4">Filters</h2>
        <form method="GET" action="{{ route('reports.attendance') }}" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[180px]">
                <label class="block text-xs font-medium text-slate-600 dark:text-slate-400 mb-1">Camp</label>
                <select name="camp_id"
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
                    Apply Filters
                </button>
                <a href="{{ route('reports.attendance') }}"
                   class="inline-flex items-center px-4 py-2 rounded-xl border border-slate-200 dark:border-zinc-700 text-sm font-medium text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-zinc-800 transition">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- Stats Cards --}}
    @if($attendanceStats->isNotEmpty())
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
        @foreach($attendanceStats as $stat)
        <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-slate-200 dark:border-zinc-800 p-6 space-y-4">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="font-bold text-slate-800 dark:text-white text-lg">{{ $stat['camp']->name }}</h3>
                    <p class="text-xs text-slate-400 mt-0.5 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        {{ $stat['camp']->location }}
                    </p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold
                    {{ $stat['occupancy_pct'] >= 90 ? 'bg-red-100 text-red-700' : ($stat['occupancy_pct'] >= 70 ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700') }}">
                    {{ $stat['occupancy_pct'] }}% full
                </span>
            </div>

            {{-- Occupancy Bar --}}
            <div>
                <div class="flex justify-between text-xs text-slate-500 mb-1">
                    <span>Occupancy</span>
                    <span>{{ $stat['families_count'] }} / {{ $stat['capacity'] }}</span>
                </div>
                <div class="w-full bg-slate-100 dark:bg-zinc-800 rounded-full h-2">
                    <div class="h-2 rounded-full transition-all duration-500
                        {{ $stat['occupancy_pct'] >= 90 ? 'bg-red-500' : ($stat['occupancy_pct'] >= 70 ? 'bg-amber-500' : 'bg-emerald-500') }}"
                        style="width: {{ min($stat['occupancy_pct'], 100) }}%">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div class="bg-slate-50 dark:bg-zinc-800 rounded-xl p-3 text-center">
                    <p class="text-2xl font-bold text-emerald-600">{{ number_format($stat['families_count']) }}</p>
                    <p class="text-xs text-slate-500 mt-0.5">Families</p>
                </div>
                <div class="bg-slate-50 dark:bg-zinc-800 rounded-xl p-3 text-center">
                    <p class="text-2xl font-bold text-blue-600">{{ number_format($stat['members_count']) }}</p>
                    <p class="text-xs text-slate-500 mt-0.5">Members</p>
                </div>
                <div class="bg-slate-50 dark:bg-zinc-800 rounded-xl p-3 text-center">
                    <p class="text-2xl font-bold text-violet-600">{{ number_format($stat['distributions']) }}</p>
                    <p class="text-xs text-slate-500 mt-0.5">Distributions</p>
                </div>
                <div class="bg-slate-50 dark:bg-zinc-800 rounded-xl p-3 text-center">
                    <p class="text-2xl font-bold text-amber-500">{{ $stat['receipt_rate'] }}%</p>
                    <p class="text-xs text-slate-500 mt-0.5">Receipt Rate</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Attendance Table --}}
    <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-slate-200 dark:border-zinc-800 overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-slate-100 dark:border-zinc-800">
            <h2 class="font-semibold text-slate-700 dark:text-slate-200">Detailed Attendance Table</h2>
            {{-- CSV Export --}}
            <form method="GET" action="{{ route('reports.export-csv') }}">
                <input type="hidden" name="camp_id" value="{{ $campId }}">
                <input type="hidden" name="date_from" value="{{ $dateFrom }}">
                <input type="hidden" name="date_to" value="{{ $dateTo }}">
                <input type="hidden" name="format" value="csv">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold transition shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    Export CSV
                </button>
            </form>
        </div>
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
                        <th class="text-right px-6 py-3 font-semibold">Pending</th>
                        <th class="text-right px-6 py-3 font-semibold">Receipt Rate</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-zinc-800">
                    @foreach($attendanceStats as $stat)
                    <tr class="hover:bg-slate-50 dark:hover:bg-zinc-800/30 transition">
                        <td class="px-6 py-4 font-semibold text-slate-800 dark:text-slate-200">{{ $stat['camp']->name }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $stat['camp']->location }}</td>
                        <td class="px-6 py-4 text-right text-slate-600">{{ number_format($stat['capacity']) }}</td>
                        <td class="px-6 py-4 text-right font-semibold text-emerald-600">{{ number_format($stat['families_count']) }}</td>
                        <td class="px-6 py-4 text-right text-blue-600">{{ number_format($stat['members_count']) }}</td>
                        <td class="px-6 py-4 text-right text-violet-600">{{ number_format($stat['distributions']) }}</td>
                        <td class="px-6 py-4 text-right text-amber-600">{{ number_format($stat['received']) }}</td>
                        <td class="px-6 py-4 text-right text-rose-600">{{ number_format($stat['pending']) }}</td>
                        <td class="px-6 py-4 text-right">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold
                                {{ $stat['receipt_rate'] >= 80 ? 'bg-emerald-100 text-emerald-700' : ($stat['receipt_rate'] >= 50 ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">
                                {{ $stat['receipt_rate'] }}%
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @else
        <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-slate-200 dark:border-zinc-800 p-12 text-center text-slate-400">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-3 opacity-30"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/></svg>
            <p class="text-sm">No attendance data found for the selected filters.</p>
        </div>
    @endif

</div>
@endsection
