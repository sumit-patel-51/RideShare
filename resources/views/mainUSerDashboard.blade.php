@extends('layouts.dashboard')

@section('content')
    <style>
        .stat-card {
            border: 2px solid #000;
            border-radius: 20px;
            background: #fff;
            box-shadow: 6px 6px 0px 0px #000;
            transition: 0.2s;
        }

        .stat-card:hover {
            transform: translate(-2px, -2px);
            box-shadow: 8px 8px 0px 0px #FF9F43;
        }

        .stat-label {
            font-size: 0.75rem;
            font-weight: 900;
            text-transform: uppercase;
            color: #666;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 900;
            color: #000;
        }

        .activity-card {
            border: 2px solid #000;
            border-radius: 20px;
            background: #fff;
            height: 100%;
        }

        .list-group-item {
            border: none;
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }
    </style>

    <div class="container-fluid py-3">
        <div class="mb-4">
            <h2 class="fw-black">Welcome back, {{ auth()->user()->name }}! 👋</h2>
            <p class="text-muted fw-bold">Here is what's happening with your account today.</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-6 col-md-3">
                <div class="stat-card p-3 p-md-4">
                    <span class="stat-label">Total Rides</span>
                    <div class="stat-value">🚗 {{ $totalRides }}</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card p-3 p-md-4">
                    <span class="stat-label">Completed</span>
                    <div class="stat-value text-success">✅ {{ $completedRides }}</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card p-3 p-md-4">
                    <span class="stat-label">My Bookings</span>
                    <div class="stat-value">🎟️ {{ $totalBookings }}</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card p-3 p-md-4">
                    <span class="stat-label">Avg Rating</span>
                    <div class="stat-value text-warning">⭐ {{ round($avgRating, 1) }}</div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="activity-card p-4 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-black m-0 text-uppercase">Recent Posts (Driver)</h5>
                        <a href="{{ route('rides.my') }}" class="btn btn-sm btn-outline-dark fw-bold rounded-pill">View
                            All</a>
                    </div>

                    <div class="list-group">
                        @forelse($recentRides as $ride)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <span class="fw-black d-block">{{ $ride->pickup_address }} →
                                            {{ $ride->drop_address }}</span>
                                        <small
                                            class="text-muted fw-bold">{{ \Carbon\Carbon::parse($ride->date)->format('M d') }}
                                            at {{ $ride->time }}</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-dark rounded-pill">₹{{ $ride->price }}</span>
                                        <small class="d-block text-success fw-bold mt-1"
                                            style="font-size: 10px;">{{ $ride->status }}</small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted py-4 text-center fw-bold">No rides posted yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="activity-card p-4 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-black m-0 text-uppercase">My Recent Bookings</h5>
                        <a href="{{ route('rides.bookings') }}"
                            class="btn btn-sm btn-outline-dark fw-bold rounded-pill">View All</a>
                    </div>

                    <div class="list-group">
                        @forelse($recentBookings as $booking)
                            <div class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <span class="fw-black d-block">{{ $booking->ride->pickup_address }} →
                                            {{ $booking->ride->drop_address }}</span>
                                        <small class="text-muted fw-bold">Driver: {{ $booking->ride->user->name }}</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge rounded-pill border border-dark text-dark"
                                            style="background: #FF9F43">{{ $booking->status }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted py-4 text-center fw-bold">No bookings found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection