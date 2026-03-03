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
         

        <!-- Distributions Card -->
        

    <!-- Tables/Activities Placeholder -->
    
            <div class="space-y-4">
                <!-- Activity Item -->
                <div class="flex items-center gap-4 p-4 hover:bg-slate-50 dark:hover:bg-zinc-800/50 rounded-2xl transition-all border border-transparent hover:border-slate-100 dark:hover:border-zinc-800">
                 
               
                <!-- ... more items ... -->
            </div>
        </div>

        
    </div>
</div>
@endsection
