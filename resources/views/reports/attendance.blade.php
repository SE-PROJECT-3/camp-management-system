@extends('layouts.admin')

@section('title', 'Attendance Reports')

@section('content')



    <!-- Premium Gradient Header -->
    <div class="rounded-3xl p-10 text-white shadow-2xl
        bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500">

        <h2 class="text-4xl font-bold mb-3">Attendance Reports 📈</h2>
        <p class="text-emerald-100 max-w-2xl">
            Analyze camp attendance performance and monitor engagement levels.
        </p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="p-8 rounded-2xl bg-gradient-to-br from-emerald-50 to-emerald-100 shadow-lg">
            <p class="text-sm text-emerald-600">Total Registered</p>
            <p id="registered" class="text-3xl font-bold mt-2">0</p>
        </div>

        <div class="p-8 rounded-2xl bg-gradient-to-br from-cyan-50 to-cyan-100 shadow-lg">
            <p class="text-sm text-cyan-600">Total Attended</p>
            <p id="attended" class="text-3xl font-bold mt-2">0</p>
        </div>

        <div class="p-8 rounded-2xl bg-gradient-to-br from-yellow-50 to-yellow-100 shadow-lg">
            <p class="text-sm text-yellow-600">Attendance Rate</p>
            <p id="rate" class="text-3xl font-bold mt-2">0%</p>
        </div>

    </div>

    <!-- Chart Section -->
    <div class="bg-white dark:bg-zinc-900 p-8 rounded-3xl shadow-xl">
        <canvas id="attendanceChart" height="100"></canvas>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    function animateValue(element, end, duration, suffix = '') {
        let start = 0;
        let startTime = null;

        function animation(currentTime) {
            if (!startTime) startTime = currentTime;
            const progress = currentTime - startTime;
            const value = Math.min(Math.floor(progress / duration * end), end);
            element.textContent = value + suffix;
            if (progress < duration) {
                requestAnimationFrame(animation);
            }
        }
        requestAnimationFrame(animation);
    }

    document.addEventListener('DOMContentLoaded', function() {

        const registered = 200;
        const attended = 174;
        const rate = 87;

        animateValue(document.getElementById('registered'), registered, 1200);
        animateValue(document.getElementById('attended'), attended, 1200);
        animateValue(document.getElementById('rate'), rate, 1200, '%');

        const ctx = document.getElementById('attendanceChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Attendance',
                    data: [60, 72, 80, 87],
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16,185,129,0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true
            }
        });

    });
</script>

@endsection