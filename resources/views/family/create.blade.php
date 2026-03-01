@extends('layouts.admin')

@section('title', 'Add New Family')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('families.index') }}" class="text-sm font-medium text-slate-500 hover:text-indigo-600 flex items-center gap-2 mb-4 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            Back to Families
        </a>
        <h2 class="text-3xl font-bold tracking-tight">Register New Family</h2>
        <p class="text-slate-500 dark:text-slate-400 mt-2">Enter family details and assign them to a camp.</p>
    </div>

    <div class="bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800 rounded-3xl p-8 shadow-sm">
        <form action="{{ route('families.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="space-y-2">
                <label for="name" class="text-sm font-semibold tracking-wide px-1">Head of Family Name</label>
                <input type="text" id="name" name="name" required placeholder="e.g. Ahmed Al-Fulan"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-zinc-800 bg-slate-50 dark:bg-zinc-800/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="members_count" class="text-sm font-semibold tracking-wide px-1">Number of Members</label>
                    <input type="number" id="members_count" name="members_count" required placeholder="1"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-zinc-800 bg-slate-50 dark:bg-zinc-800/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                </div>

                <div class="space-y-2">
                    <label for="category" class="text-sm font-semibold tracking-wide px-1">Category</label>
                    <select id="category" name="category" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-zinc-800 bg-slate-50 dark:bg-zinc-800/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                        <option value="Displaced">Displaced</option>
                        <option value="Local">Local</option>
                        <option value="Refugee">Refugee</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="priority" class="text-sm font-semibold tracking-wide px-1">Priority Level</label>
                    <select id="priority" name="priority" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-zinc-800 bg-slate-50 dark:bg-zinc-800/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                        <option value="normal">Normal</option>
                        <option value="high">High (Urgent)</option>
                        <option value="low">Low</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="camp_id" class="text-sm font-semibold tracking-wide px-1">Assigned Camp</label>
                    <select id="camp_id" name="camp_id" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-zinc-800 bg-slate-50 dark:bg-zinc-800/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                        @foreach($camps as $camp)
                            <option value="{{ $camp->id }}">{{ $camp->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 dark:border-zinc-800 flex justify-end gap-3">
                <a href="{{ route('families.index') }}" class="px-6 py-3 rounded-xl font-semibold text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-zinc-800 transition-all">
                    Cancel
                </a>
                <button type="submit" class="px-8 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold transition-all shadow-lg shadow-indigo-200 dark:shadow-none">
                    Create Family
                </button>
            </div>
        </form>
    </div>
</div>
@endsection