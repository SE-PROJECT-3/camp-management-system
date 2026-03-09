@extends('layouts.admin')

@section('title', 'Edit Distribution Record')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('distributions.index') }}" class="text-sm font-medium text-slate-500 hover:text-indigo-600 flex items-center gap-2 mb-4 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            Back to Distributions
        </a>
        <h2 class="text-3xl font-bold tracking-tight">Edit Distribution Record</h2>
        <p class="text-slate-500 dark:text-slate-400 mt-2">Adjust details for this distribution entry.</p>
    </div>

    <div class="bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800 rounded-3xl p-8 shadow-sm">
        <form action="{{ route('distributions.update', $distribution) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="family_id" class="text-sm font-semibold tracking-wide px-1">Target Family</label>
                    <select id="family_id" name="family_id" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-zinc-800 bg-slate-50 dark:bg-zinc-800/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                        @foreach($families as $family)
                            <option value="{{ $family->id }}" {{ $distribution->family_id == $family->id ? 'selected' : '' }}>
                                {{ $family->name }} ({{ $family->camp->name ?? 'No Camp' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="resource_id" class="text-sm font-semibold tracking-wide px-1">Distributed Resource</label>
                    <select id="resource_id" name="resource_id" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-zinc-800 bg-slate-50 dark:bg-zinc-800/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                        @foreach($resources as $resource)
                            <option value="{{ $resource->id }}" {{ $distribution->resource_id == $resource->id ? 'selected' : '' }}>
                                {{ $resource->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="quantity" class="text-sm font-semibold tracking-wide px-1">Quantity</label>
                    <input type="number" id="quantity" name="quantity" required value="{{ $distribution->quantity }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-zinc-800 bg-slate-50 dark:bg-zinc-800/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                </div>

                <div class="space-y-2">
                    <label for="distributed_at" class="text-sm font-semibold tracking-wide px-1">Distribution Date</label>
                    <input type="datetime-local" id="distributed_at" name="distributed_at" 
                        value="{{ $distribution->distributed_at ? $distribution->distributed_at->format('Y-m-d\TH:i') : '' }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-zinc-800 bg-slate-50 dark:bg-zinc-800/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                </div>
            </div>

            <div class="flex items-center gap-3 px-1">
                <input type="checkbox" id="received" name="received" value="1" {{ $distribution->received ? 'checked' : '' }}
                    class="w-5 h-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 transition-all">
                <label for="received" class="text-sm font-medium text-slate-700 dark:text-slate-300">Has been received by family</label>
            </div>

            <div class="pt-4 border-t border-slate-100 dark:border-zinc-800 flex justify-end gap-3">
                <a href="{{ route('distributions.index') }}" class="px-6 py-3 rounded-xl font-semibold text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-zinc-800 transition-all">
                    Cancel
                </a>
                <button type="submit" class="px-8 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold transition-all shadow-lg shadow-indigo-200 dark:shadow-none">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection