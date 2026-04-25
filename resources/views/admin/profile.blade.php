@extends('admin.layout.app')

@section('title', 'User Profile | Admin Control')

@section('content')
    <style>
        /* --- Main UI Elements --- */
        .admin-card {
            border: 3px solid #000;
            border-radius: 24px;
            background: #fff;
            box-shadow: 8px 8px 0px 0px #000;
        }

        .status-pill {
            font-weight: 800;
            text-transform: uppercase;
            font-size: 0.65rem;
            padding: 4px 10px;
            border: 2px solid #000;
            border-radius: 8px;
        }

        .activity-section {
            background: #f8f9fa;
            border: 3px solid #000;
            border-radius: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .ticket-item {
            background: #fff;
            border: 2px solid #000;
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 12px;
            transition: 0.2s;
        }

        .ticket-item:hover {
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0px 0px #FF9F43;
        }

        /* --- Scrollable Logic --- */
        .scrollable-activity {
            max-height: 380px;
            /* Locked height */
            overflow-y: auto;
            padding-right: 8px;
            flex-grow: 1;
        }

        /* Custom Branded Scrollbar */
        .scrollable-activity::-webkit-scrollbar {
            width: 8px;
        }

        .scrollable-activity::-webkit-scrollbar-track {
            background: #eee;
            border-radius: 10px;
            border: 1px solid #000;
        }

        .scrollable-activity::-webkit-scrollbar-thumb {
            background: #000;
            border-radius: 10px;
        }

        .scrollable-activity::-webkit-scrollbar-thumb:hover {
            background: #FF9F43;
        }

        .info-label {
            font-weight: 900;
            text-transform: uppercase;
            font-size: 0.7rem;
            color: #666;
            letter-spacing: 0.5px;
        }
    </style>

    <div class="container-fluid py-4">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('admin.users') }}" class="btn btn-outline-dark rounded-circle me-3"
                style="width: 40px; height: 40px; border-width: 2px;">←</a>
            <h3 class="fw-black m-0 text-uppercase">User Command Center</h3>
        </div>

        <div class="admin-card mb-5">
            <div class="card-body p-4 p-md-5">
                <div class="row align-items-center g-4">
                    <div class="col-12 col-md-auto text-center">
                        @if ($user->image)
                            <img src="{{ asset('userImages/' . $user->image) }}"
                                class="rounded-circle border border-4 border-dark shadow-sm"
                                style="width: 130px; height: 130px; object-fit: cover;">
                        @else
                            <div class="rounded-circle border border-4 border-dark d-flex align-items-center justify-content-center bg-light shadow-sm mx-auto"
                                style="width: 130px; height: 130px; background-color: #FF9F43 !important;">
                                <span class="fw-black display-3 text-dark">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="col-12 col-md text-center text-md-start">
                        <h2 class="fw-black mb-1">{{ $user->name }}</h2>
                        <p class="text-muted fw-bold mb-3">System ID: #USR-{{ $user->id }} | Member since
                            {{ $user->created_at->format('M Y') }}</p>
                        <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-2">
                            <span class="badge border-2 border-dark text-dark px-3 py-2 rounded-pill shadow-sm"
                                style="background-color: #FF9F43; font-weight: 800;">
                                ✉️ {{ $user->email }}
                            </span>
                            <span
                                class="status-pill {{ $user->status == 'active' ? 'bg-success text-white' : 'bg-danger text-white' }}">
                                {{ $user->status }}
                            </span>
                        </div>
                    </div>

                    <div
                        class="col-12 col-md-auto text-center text-md-end pt-3 pt-md-0 border-top border-md-0 border-dark border-opacity-10">
                        <div class="h1 fw-black mb-0 text-dark" style="font-size: 3rem;">⭐
                            {{ round($avgRating, 1) ?? '0.0' }}</div>
                        <p class="text-muted fw-bold small text-uppercase mb-0">Total Reputation: {{ $totalRatings }}
                            Reviews</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-6">
                <div class="activity-section p-4 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-black m-0 text-uppercase">🚗 Posted Rides</h5>
                        <span class="badge bg-dark rounded-pill">{{ count($rides) }} Total</span>
                    </div>

                    <div class="scrollable-activity">
                        @forelse($rides as $ride)
                            <div class="ticket-item d-flex justify-content-between align-items-center">
                                <div class="overflow-hidden">
                                    <span class="fw-black d-block text-truncate small">{{ $ride->pickup_address }} →
                                        {{ $ride->drop_address }}</span>
                                    <small
                                        class="text-muted fw-bold">{{ \Carbon\Carbon::parse($ride->date)->format('d M, Y') }}</small>
                                </div>
                                <span class="status-pill bg-light flex-shrink-0 ms-2">{{ $ride->status }}</span>
                            </div>
                        @empty
                            <div class="text-center py-5 opacity-50">
                                <h6 class="fw-bold">No ride data available</h6>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="activity-section p-4 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-black m-0 text-uppercase">🎟️ Recent Bookings</h5>
                        <span class="badge bg-dark rounded-pill">{{ count($bookings) }} Total</span>
                    </div>

                    <div class="scrollable-activity">
                        @forelse($bookings as $booking)
                            <div class="ticket-item d-flex justify-content-between align-items-center">
                                <div class="overflow-hidden">
                                    <span class="fw-black d-block text-truncate small">{{ $booking->ride->pickup_address }} →
                                        {{ $booking->ride->drop_address }}</span>
                                    <small class="text-muted fw-bold">Booking ID: #BK-{{ $booking->id }}</small>
                                </div>
                                <span class="status-pill bg-light flex-shrink-0 ms-2">{{ $booking->status }}</span>
                            </div>
                        @empty
                            <div class="text-center py-5 opacity-50">
                                <h6 class="fw-bold">No booking data available</h6>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h4 class="fw-black mb-4 px-1 text-uppercase">📝 Reputation History</h4>

                @forelse ($rev as $revs)
                    <div class="admin-card mb-3 overflow-hidden" style="border-width: 2px; border-radius: 20px;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                                <div class="d-flex align-items-center gap-3">
                                    @if ($revs->giver->image)
                                        <img src="{{ asset('userImages/' . $revs->giver->image) }}"
                                            class="rounded-circle border border-2 border-dark"
                                            style="width: 45px; height: 45px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle border border-2 border-dark d-flex align-items-center justify-content-center bg-light shadow-sm"
                                            style="width: 45px; height: 45px; background-color: #FF9F43 !important;">
                                            <span class="fw-black">{{ substr($revs->giver->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="fw-black mb-0 text-dark">{{ $revs->giver->name }}</p>
                                        <div class="text-warning small">
                                            @for($i = 1; $i <= 5; $i++)
                                                {{ $i <= $revs->rating ? '★' : '☆' }}
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted fw-black">{{ $revs->created_at->diffForHumans() }}</small>
                            </div>

                            <div class="ps-md-5">
                                <div class="p-3 bg-light rounded-3 border-start border-4 border-warning shadow-sm">
                                    <p class="mb-0 fw-medium text-dark-emphasis small"
                                        style="font-style: italic; line-height: 1.6;">
                                        "{{ $revs->review }}"
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 border-3 border-dark border-dashed rounded-5 bg-white">
                        <p class="text-muted fw-black mb-0 opacity-50">NO COMMUNITY FEEDBACK FOUND</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection