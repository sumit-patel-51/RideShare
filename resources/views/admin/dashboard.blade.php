@extends('admin.layout.app')

@section('title', 'Admin Dashboard')

@section('content')
    <style>
        .stat-card {
            border: 3px solid #000;
            border-radius: 20px;
            background: #fff;
            box-shadow: 8px 8px 0px 0px #000;
            transition: 0.2s;
            height: 100%;
        }

        .stat-card:hover {
            transform: translate(-3px, -3px);
            box-shadow: 10px 10px 0px 0px #FF9F43;
        }

        .stat-label {
            font-weight: 800;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            color: #666;
        }

        .stat-value {
            font-weight: 900;
            font-size: 2rem;
            margin-top: 5px;
            display: block;
        }

        .chart-container {
            border: 3px solid #000;
            border-radius: 24px;
            background: #fff;
            box-shadow: 8px 8px 0px 0px #f0f0f0;
        }

        .chart-title {
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
    </style>

    <div class="container-fluid py-4">
        <div class="mb-4">
            <h2 class="fw-black">SYSTEM OVERVIEW</h2>
            <p class="text-muted fw-bold">Live analytics and performance metrics.</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-6 col-md-3">
                <div class="stat-card p-4">
                    <span class="stat-label">Total Users</span>
                    <span class="stat-value text-dark">👤 {{ $totalUsers }}</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card p-4">
                    <span class="stat-label">Active Rides</span>
                    <span class="stat-value text-dark">🚗 {{ $totalRides }}</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card p-4">
                    <span class="stat-label">Total Bookings</span>
                    <span class="stat-value text-dark">🎟️ {{ $totalBookings }}</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card p-4">
                    <span class="stat-label">Avg Rating</span>
                    <span class="stat-value text-warning">⭐ {{ round($avgRating, 1) }}</span>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="chart-container p-4">
                    <h5 class="chart-title">📈 Monthly Growth (Rides)</h5>
                    <canvas id="ridesChart" style="max-height: 350px;"></canvas>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="chart-container p-4">
                    <h5 class="chart-title">📊 Booking Volume</h5>
                    <canvas id="bookingsChart" style="max-height: 350px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const months = @json($months);
        const ridesData = @json($rides);
        const bookingsData = @json($bookings);

        Chart.defaults.font.family = "'Inter', sans-serif";
        Chart.defaults.font.weight = '600';

        // Rides Line Chart (Branded Orange)
        new Chart(document.getElementById('ridesChart'), {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Rides Posted',
                    data: ridesData,
                    borderColor: '#FF9F43',
                    backgroundColor: 'rgba(255, 159, 67, 0.1)',
                    borderWidth: 4,
                    pointBackgroundColor: '#000',
                    pointBorderColor: '#fff',
                    pointRadius: 6,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { display: false }, ticks: { stepSize: 1 } },
                    x: { grid: { display: false } }
                }
            }
        });

        // Bookings Bar Chart (Branded Black)
        new Chart(document.getElementById('bookingsChart'), {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Bookings Made',
                    data: bookingsData,
                    backgroundColor: '#000',
                    borderRadius: 10,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { display: false } },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
@endsection