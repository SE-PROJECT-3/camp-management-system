@extends('layouts.admin')

@section('content')

<div class="space-y-10">

    <!-- Header -->
    <div class="bg-gradient-to-r from-cyan-500 to-emerald-500 rounded-2xl p-8 shadow-xl">
        <h1 class="text-4xl font-bold text-white">
            Aid Distribution Report 🎁
        </h1>
        <p class="text-white/80 mt-2">
            Track aid allocation, monitor distribution history and generate exportable reports.
        </p>
    </div>

    <!-- Filters Section -->
    <div class="bg-[#111827] rounded-2xl p-6 shadow-lg border border-white/5">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <div>
                <label class="text-sm text-gray-400">Camp</label>
                <select class="w-full mt-2 bg-[#1f2937] text-white rounded-lg p-2 border border-white/10">
                    <option>All Camps</option>
                    <option>Camp A</option>
                    <option>Camp B</option>
                </select>
            </div>

            <div>
                <label class="text-sm text-gray-400">From</label>
                <input type="date"
                       class="w-full mt-2 bg-[#1f2937] text-white rounded-lg p-2 border border-white/10">
            </div>

            <div>
                <label class="text-sm text-gray-400">To</label>
                <input type="date"
                       class="w-full mt-2 bg-[#1f2937] text-white rounded-lg p-2 border border-white/10">
            </div>

            <div>
                <label class="text-sm text-gray-400">Aid Type</label>
                <select class="w-full mt-2 bg-[#1f2937] text-white rounded-lg p-2 border border-white/10">
                    <option>All Types</option>
                    <option>Food</option>
                    <option>Medical</option>
                    <option>Financial</option>
                </select>
            </div>

        </div>

        <div class="mt-6 flex gap-4">
            <button class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-2 rounded-lg transition">
                Generate Report
            </button>

            <button class="bg-cyan-500 hover:bg-cyan-600 text-white px-6 py-2 rounded-lg transition">
                Export PDF
            </button>

            <button class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-2 rounded-lg transition">
                Export Excel
            </button>
        </div>

    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-[#111827] rounded-2xl p-6 shadow-lg border border-white/5">
            <p class="text-emerald-400 text-sm">Total Distributions</p>
            <h2 class="text-3xl font-bold text-white mt-2">320</h2>
        </div>

        <div class="bg-[#111827] rounded-2xl p-6 shadow-lg border border-white/5">
            <p class="text-cyan-400 text-sm">Families Supported</p>
            <h2 class="text-3xl font-bold text-white mt-2">185</h2>
        </div>

        <div class="bg-[#111827] rounded-2xl p-6 shadow-lg border border-white/5">
            <p class="text-purple-400 text-sm">Total Aid Value</p>
            <h2 class="text-3xl font-bold text-white mt-2">$12,500</h2>
        </div>

    </div>

    <!-- Results Table -->
    <div class="bg-[#111827] rounded-2xl p-6 shadow-lg border border-white/5">

        <h3 class="text-lg font-semibold text-white mb-4">Distribution History</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-gray-300">
                <thead class="text-gray-400 border-b border-white/10">
                    <tr>
                        <th class="py-3">Family</th>
                        <th>Aid Type</th>
                        <th>Date</th>
                        <th>Camp</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">

                    <tr class="hover:bg-white/5 transition">
                        <td class="py-3">Ahmad Family</td>
                        <td>Food</td>
                        <td>2026-01-10</td>
                        <td>Camp A</td>
                        <td class="text-emerald-400">Completed</td>
                    </tr>

                    <tr class="hover:bg-white/5 transition">
                        <td class="py-3">Hassan Family</td>
                        <td>Medical</td>
                        <td>2026-01-14</td>
                        <td>Camp B</td>
                        <td class="text-emerald-400">Completed</td>
                    </tr>

                    <tr class="hover:bg-white/5 transition">
                        <td class="py-3">Ali Family</td>
                        <td>Financial</td>
                        <td>2026-01-18</td>
                        <td>Camp A</td>
                        <td class="text-yellow-400">Pending</td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection