@extends('layouts.admin')

@section('content')

<div class="space-y-10">

    <!-- Header -->
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl p-8 shadow-xl">
        <h1 class="text-4xl font-bold text-white">
            Reports Center 📊
        </h1>
        <p class="text-white/80 mt-2">
            Generate powerful insights and export professional reports with just a few clicks.
        </p>
    </div>

    <!-- Reports Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- Attendance -->
        <a href="{{ url('/attendance-reports') }}"
           class="group bg-[#111827] rounded-2xl p-6 shadow-lg border border-white/5 hover:scale-105 transition duration-300">
            <div class="text-emerald-400 text-3xl mb-4">📈</div>
            <h3 class="text-white text-lg font-semibold group-hover:text-emerald-400">
                Attendance Report
            </h3>
            <p class="text-gray-400 text-sm mt-2">
                Analyze attendance performance and engagement trends.
            </p>
        </a>

        <!-- Aid Distribution -->
        <a href="{{ url('/aid-reports') }}"
           class="group bg-[#111827] rounded-2xl p-6 shadow-lg border border-white/5 hover:scale-105 transition duration-300">
            <div class="text-cyan-400 text-3xl mb-4">🎁</div>
            <h3 class="text-white text-lg font-semibold group-hover:text-cyan-400">
                Aid Distribution Report
            </h3>
            <p class="text-gray-400 text-sm mt-2">
                Track aid allocation and distribution history.
            </p>
        </a>

        <!-- Families -->
        <a href="#"
           class="group bg-[#111827] rounded-2xl p-6 shadow-lg border border-white/5 hover:scale-105 transition duration-300">
            <div class="text-purple-400 text-3xl mb-4">👨‍👩‍👧</div>
            <h3 class="text-white text-lg font-semibold group-hover:text-purple-400">
                Families Summary
            </h3>
            <p class="text-gray-400 text-sm mt-2">
                Overview of registered families and support status.
            </p>
        </a>

        <!-- Camps -->
        <a href="#"
           class="group bg-[#111827] rounded-2xl p-6 shadow-lg border border-white/5 hover:scale-105 transition duration-300">
            <div class="text-yellow-400 text-3xl mb-4">🏕</div>
            <h3 class="text-white text-lg font-semibold group-hover:text-yellow-400">
                Camps Summary
            </h3>
            <p class="text-gray-400 text-sm mt-2">
                Get detailed statistics for all camps.
            </p>
        </a>

    </div>

</div>

@endsection