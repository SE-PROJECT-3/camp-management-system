@extends('layouts.admin')

@section('title', 'Add New Resource')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('resources.index') }}" class="text-sm font-medium text-slate-500 hover:text-indigo-600 flex items-center gap-2 mb-4 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            Back to Inventory
        </a>
        <h2 class="text-3xl font-bold tracking-tight">Register New Resource</h2>
        <p class="text-slate-500 dark:text-slate-400 mt-2">Add supplies to your inventory and assign them to a camp.</p>
    </div>

    <div class="bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800 rounded-3xl p-8 shadow-sm">
        <form action="{{ route('resources.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="space-y-2">
                <label for="name" class="text-sm font-semibold tracking-wide px-1">Resource Name</label>
                <input type="text" id="name" name="name" required placeholder="e.g. Flour 50kg, Medical Kit"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-zinc-800 bg-slate-50 dark:bg-zinc-800/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="type" class="text-sm font-semibold tracking-wide px-1">Resource Type</label>
                    <select id="type" name="type" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-zinc-800 bg-slate-50 dark:bg-zinc-800/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                        <option value="Food">Food / Rations</option>
                        <option value="Medical">Medical Supplies</option>
                        <option value="Clothing">Clothing / Blankets</option>
                        <option value="Tools">Tools / Equipment</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="quantity" class="text-sm font-semibold tracking-wide px-1">Initial Quantity</label>
                    <input type="number" id="quantity" name="quantity" required placeholder="0"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-zinc-800 bg-slate-50 dark:bg-zinc-800/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label for="camp_id" class="text-sm font-semibold tracking-wide px-1">Storage / Camp</label>
                    <select id="camp_id" name="camp_id" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-zinc-800 bg-slate-50 dark:bg-zinc-800/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                        @foreach($camps as $camp)
                            <option value="{{ $camp->id }}">{{ $camp->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 dark:border-zinc-800 flex justify-end gap-3">
                <a href="{{ route('resources.index') }}" class="px-6 py-3 rounded-xl font-semibold text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-zinc-800 transition-all">
                    Cancel
                </a>
                <button type="submit" class="px-8 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold transition-all shadow-lg shadow-indigo-200 dark:shadow-none">
                    Register Resource
                </button>
            </div>
        </form>
    </div>
</div>
@endsection