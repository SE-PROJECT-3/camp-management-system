@extends('layouts.admin')

@section('content')

<div class="space-y-10">

    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-2xl p-8 shadow-xl">
        <h1 class="text-4xl font-bold text-white">
            Family Aid History 👨‍👩‍👧
        </h1>
        <p class="text-white/80 mt-2">
            Detailed distribution history and aid tracking per family.
        </p>
    </div>

    <!-- Family Info Card -->
    <div class="bg-[#111827] rounded-2xl p-6 shadow-lg border border-white/5">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-semibold text-white">Ahmad Family</h2>
                <p class="text-gray-400 mt-1">Camp A • 6 Members</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-400">Total Aid Received</p>
                <h3 class="text-2xl font-bold text-emerald-400">$1,250</h3>
            </div>
        </div>
    </div>

    <!-- Timeline -->
    <div class="bg-[#111827] rounded-2xl p-8 shadow-lg border border-white/5">

        <h3 class="text-lg font-semibold text-white mb-6">Distribution Timeline</h3>

        <div class="relative border-l border-white/10 pl-6 space-y-8">

            <!-- Item -->
            <div class="relative">
                <div class="absolute -left-3 top-2 w-5 h-5 bg-emerald-500 rounded-full"></div>
                <h4 class="text-white font-semibold">Food Package</h4>
                <p class="text-gray-400 text-sm">January 10, 2026</p>
                <p class="text-gray-300 mt-2">Monthly food assistance provided.</p>
                <span class="inline-block mt-2 px-3 py-1 text-xs bg-emerald-500/20 text-emerald-400 rounded-full">
                    Completed
                </span>
            </div>

            <!-- Item -->
            <div class="relative">
                <div class="absolute -left-3 top-2 w-5 h-5 bg-cyan-500 rounded-full"></div>
                <h4 class="text-white font-semibold">Medical Support</h4>
                <p class="text-gray-400 text-sm">January 22, 2026</p>
                <p class="text-gray-300 mt-2">Emergency medical aid distributed.</p>
                <span class="inline-block mt-2 px-3 py-1 text-xs bg-cyan-500/20 text-cyan-400 rounded-full">
                    Completed
                </span>
            </div>

            <!-- Item -->
            <div class="relative">
                <div class="absolute -left-3 top-2 w-5 h-5 bg-yellow-500 rounded-full"></div>
                <h4 class="text-white font-semibold">Financial Aid</h4>
                <p class="text-gray-400 text-sm">February 3, 2026</p>
                <p class="text-gray-300 mt-2">Cash assistance pending approval.</p>
                <span class="inline-block mt-2 px-3 py-1 text-xs bg-yellow-500/20 text-yellow-400 rounded-full">
                    Pending
                </span>
            </div>

        </div>

    </div>

</div>

@endsection