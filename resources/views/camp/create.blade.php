@extends('layouts.admin')

@section('title', 'Create New Camp')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('camps.index') }}" class="text-sm font-medium text-slate-500 hover:text-indigo-600 flex items-center gap-2 mb-4 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            Back to Camps
        </a>
        <h2 class="text-3xl font-bold tracking-tight">Register New Camp</h2>
        <p class="text-slate-500 dark:text-slate-400 mt-2">Enter the details of the new camp to add it to the system.</p>
    </div>

    <div class="bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800 rounded-3xl p-8 shadow-sm">
        <form action="{{ route('camps.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="name" class="text-sm font-semibold tracking-wide px-1">Camp Name</label>
                    <input type="text" id="name" name="name" required placeholder="e.g. North Alpha"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-zinc-800 bg-slate-50 dark:bg-zinc-800/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                </div>

                <div class="space-y-2">
                    <label for="location" class="text-sm font-semibold tracking-wide px-1">Location / Sector</label>
                    <input type="text" id="location" name="location" required placeholder="e.g. Sector 4-B"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-zinc-800 bg-slate-50 dark:bg-zinc-800/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                </div>

                <div class="space-y-2">
                    <label for="capacity" class="text-sm font-semibold tracking-wide px-1">General Capacity</label>
                    <input type="number" id="capacity" name="capacity" placeholder="0"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-zinc-800 bg-slate-50 dark:bg-zinc-800/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                </div>

                <div class="space-y-2">
                    <label for="families_count" class="text-sm font-semibold tracking-wide px-1">Initial Families Count</label>
                    <input type="number" id="families_count" name="families_count" placeholder="0"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-zinc-800 bg-slate-50 dark:bg-zinc-800/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 dark:border-zinc-800 flex justify-end gap-3">
                <a href="{{ route('camps.index') }}" class="px-6 py-3 rounded-xl font-semibold text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-zinc-800 transition-all">
                    Cancel
                </a>
                <button type="submit" class="px-8 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold transition-all shadow-lg shadow-indigo-200 dark:shadow-none">
                    Create Camp
                </button>
            </div>
        </form>
    </div>
</div>
@endsection