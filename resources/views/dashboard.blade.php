@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-white dark:bg-zinc-900 p-8 rounded-3xl border border-slate-200 dark:border-zinc-800 shadow-sm">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-3xl font-bold tracking-tight mb-2">Welcome back, Admin! 👋</h2>
                <p class="text-slate-500 dark:text-slate-400 max-w-xl">Track and manage your camps, family distributions, and resources all in one place. Here's what's happening today.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('camps.create') }}" class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition-all shadow-lg shadow-indigo-200 dark:shadow-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    New Camp
                </a>
            </div>
        </div>
        
        <!-- Abstract Decorations -->
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-indigo-50 dark:bg-indigo-900/10 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-slate-50 dark:bg-zinc-800/20 rounded-full blur-3xl opacity-50"></div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Camps Card -->
        <div class="group bg-white dark:bg-zinc-900 p-6 rounded-3xl border border-slate-200 dark:border-zinc-800 hover:border-indigo-200 dark:hover:border-indigo-500/30 transition-all duration-300">
            <div class="flex items-start justify-between mb-4">
                <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/20 rounded-2xl flex items-center justify-center text-indigo-600 dark:text-indigo-400 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </div>
                <span class="text-xs font-medium text-emerald-600 bg-emerald-50 dark:bg-emerald-500/10 px-2 py-1 rounded-full">+12%</span>
            </div>
            <h3 class="text-slate-500 dark:text-slate-400 text-sm font-medium">Total Camps</h3>
            <p class="text-2xl font-bold mt-1">{{ $camps_count }}</p>
        </div>

        <!-- Families Card -->
        <div class="group bg-white dark:bg-zinc-900 p-6 rounded-3xl border border-slate-200 dark:border-zinc-800 hover:border-violet-200 dark:hover:border-violet-500/30 transition-all duration-300">
            <div class="flex items-start justify-between mb-4">
                <div class="w-12 h-12 bg-violet-50 dark:bg-violet-900/20 rounded-2xl flex items-center justify-center text-violet-600 dark:text-violet-400 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><circle cx="18" cy="11" r="3"/></svg>
                </div>
                <span class="text-xs font-medium text-emerald-600 bg-emerald-50 dark:bg-emerald-500/10 px-2 py-1 rounded-full">+5%</span>
            </div>
            <h3 class="text-slate-500 dark:text-slate-400 text-sm font-medium">Total Families</h3>
            <p class="text-2xl font-bold mt-1">{{ $families_count }}</p>
        </div>

        <!-- Resources Card -->
        <div class="group bg-white dark:bg-zinc-900 p-6 rounded-3xl border border-slate-200 dark:border-zinc-800 hover:border-amber-200 dark:hover:border-amber-500/30 transition-all duration-300">
            <div class="flex items-start justify-between mb-4">
                <div class="w-12 h-12 bg-amber-50 dark:bg-amber-900/20 rounded-2xl flex items-center justify-center text-amber-600 dark:text-amber-400 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                </div>
                <span class="text-xs font-medium text-slate-500 bg-slate-100 dark:bg-zinc-800 px-2 py-1 rounded-full">Stable</span>
            </div>
            <h3 class="text-slate-500 dark:text-slate-400 text-sm font-medium">Available Resources</h3>
            <p class="text-2xl font-bold mt-1">{{ $resources_count }}</p>
        </div>

        <!-- Distributions Card -->
        <div class="group bg-white dark:bg-zinc-900 p-6 rounded-3xl border border-slate-200 dark:border-zinc-800 hover:border-pink-200 dark:hover:border-pink-500/30 transition-all duration-300">
            <div class="flex items-start justify-between mb-4">
                <div class="w-12 h-12 bg-pink-50 dark:bg-pink-900/20 rounded-2xl flex items-center justify-center text-pink-600 dark:text-pink-400 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22v-5"/><path d="M9 7V2"/><path d="M15 7V2"/><path d="M12 11a4 4 0 0 0-4 4v2h8v-2a4 4 0 0 0-4-4Z"/><path d="M5 22h14"/></svg>
                </div>
                <span class="text-xs font-medium text-emerald-600 bg-emerald-50 dark:bg-emerald-500/10 px-2 py-1 rounded-full">+24%</span>
            </div>
            <h3 class="text-slate-500 dark:text-slate-400 text-sm font-medium">Distributions</h3>
            <p class="text-2xl font-bold mt-1">{{ $distributions_count }}</p>
        </div>
    </div>

    <!-- Tables/Activities Placeholder -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
        <div class="bg-white dark:bg-zinc-900 p-8 rounded-3xl border border-slate-200 dark:border-zinc-800">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold tracking-tight">Recent Camps</h3>
                <a href="{{ route('camps.index') }}" class="text-sm font-medium text-indigo-600 hover:underline">View All</a>
            </div>
            <div class="space-y-4">
                <!-- Activity Item -->
                <div class="flex items-center gap-4 p-4 hover:bg-slate-50 dark:hover:bg-zinc-800/50 rounded-2xl transition-all border border-transparent hover:border-slate-100 dark:hover:border-zinc-800">
                    <div class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-zinc-800 flex items-center justify-center font-bold">1</div>
                    <div class="flex-1">
                        <p class="font-semibold">North Camp Alpha</p>
                        <p class="text-xs text-slate-500 tracking-wide">Location: Sector 4-B</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-block w-2h-2 rounded-full bg-emerald-500 mr-1"></span>
                        <span class="text-sm font-medium text-slate-600 dark:text-slate-400">Active</span>
                    </div>
                </div>
                <!-- ... more items ... -->
            </div>
        </div>

        <div class="bg-white dark:bg-zinc-900 p-8 rounded-3xl border border-slate-200 dark:border-zinc-800">
            <h3 class="text-xl font-bold tracking-tight mb-6 text-center lg:text-left">Quick Actions</h3>
            <div class="grid grid-cols-2 gap-4">
                <button class="flex flex-col items-center justify-center p-6 rounded-2xl bg-slate-50 dark:bg-zinc-800/40 hover:bg-slate-100 dark:hover:bg-zinc-800 transition-all gap-3 border border-slate-100 dark:border-zinc-800">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-600"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/></svg>
                    <span class="text-sm font-semibold">Generate Report</span>
                </button>
                <button class="flex flex-col items-center justify-center p-6 rounded-2xl bg-slate-50 dark:bg-zinc-800/40 hover:bg-slate-100 dark:hover:bg-zinc-800 transition-all gap-3 border border-slate-100 dark:border-zinc-800">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-amber-600"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    <span class="text-sm font-semibold">Low Resources</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
