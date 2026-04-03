@extends('layouts.admin')

@section('title', 'Families List')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold tracking-tight">Families Management</h2>
            <p class="text-slate-500 dark:text-slate-400 text-sm">Manage families across all camps.</p>
        </div>
        <a href="{{ route('families.create') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path d="M5 12h14"/><path d="M12 5v14"/>
            </svg>
            Add New Family
        </a>
    </div>

    <!-- 🔍 Search & Filter -->
    <div class="bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800 rounded-2xl p-4 shadow-sm">
        <form method="GET" action="{{ route('families.index') }}" class="grid md:grid-cols-4 gap-4">

            <!-- Search Name -->
            <input type="text" name="name" value="{{ request('name') }}"
                placeholder="Search by name..."
                class="px-4 py-2 rounded-xl border dark:border-zinc-700 bg-white dark:bg-zinc-800 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">

            <!-- Camp Filter -->
            <select name="camp_id"
                class="px-4 py-2 rounded-xl border dark:border-zinc-700 bg-white dark:bg-zinc-800 text-sm">
                <option value="">All Camps</option>
                @foreach($camps as $camp)
                    <option value="{{ $camp->id }}" {{ request('camp_id') == $camp->id ? 'selected' : '' }}>
                        {{ $camp->name }}
                    </option>
                @endforeach
            </select>

            <!-- Priority Filter -->
            <select name="priority"
                class="px-4 py-2 rounded-xl border dark:border-zinc-700 bg-white dark:bg-zinc-800 text-sm">
                <option value="">All Priority</option>
                <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                <option value="normal" {{ request('priority') == 'normal' ? 'selected' : '' }}>Normal</option>
                <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
            </select>

            <!-- Buttons -->
            <div class="flex gap-2">
                <button type="submit"
                    class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl text-sm font-semibold">
                    Search
                </button>

                <a href="{{ route('families.index') }}"
                   class="flex-1 text-center bg-slate-200 dark:bg-zinc-700 hover:bg-slate-300 dark:hover:bg-zinc-600 px-4 py-2 rounded-xl text-sm font-semibold">
                    Reset
                </a>
            </div>

        </form>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800 rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-zinc-800/50 border-b border-slate-200 dark:border-zinc-800 text-xs font-semibold uppercase tracking-wider text-slate-500">
                        <th class="px-6 py-4">Family Name</th>
                        <th class="px-6 py-4">Camp</th>
                        <th class="px-6 py-4">Members</th>
                        <th class="px-6 py-4">Priority</th>
                        <th class="px-6 py-4">Contact</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-zinc-800 text-sm">
                    @forelse ($families as $family)
                        <tr class="hover:bg-slate-50 dark:hover:bg-zinc-800/30 transition-colors">
                            
                            <td class="px-6 py-4 font-semibold">{{ $family->name }}</td>

                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400">
                                    {{ $family->camp->name ?? 'N/A' }}
                                </span>
                            </td>

                            <td class="px-6 py-4">{{ $family->members_count ?? 0 }}</td>

                            <!-- Priority Badge -->
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    @if($family->priority == 'high') bg-red-100 text-red-600
                                    @elseif($family->priority == 'normal') bg-green-100 text-green-600
                                    @else bg-yellow-100 text-yellow-600
                                    @endif">
                                    {{ ucfirst($family->priority) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-slate-500 italic">{{ $family->phone ?? 'No phone' }}</td>

                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('families.edit', $family) }}" class="inline-flex p-2 text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-lg transition-all">
                                    ✏️
                                </a>

                                <form action="{{ route('families.destroy', $family) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="p-2 text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-lg transition-all">
                                        🗑️
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                No families found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection