@extends('admin.layout.app')
@section('title', 'Booking Management')

@section('content')
    <style>
        .admin-card {
            border: 3px solid #000;
            border-radius: 20px;
            background: #fff;
            transition: 0.2s;
        }

        .admin-card:hover {
            box-shadow: 8px 8px 0px 0px #000;
            transform: translate(-3px, -3px);
        }

        .status-badge {
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 2px solid #000;
            border-radius: 8px;
            padding: 5px 12px;
            font-size: 0.7rem;
        }

        .filter-section {
            border: 3px solid #000;
            border-radius: 20px;
            background: #f8f9fa;
        }

        .form-control,
        .form-select {
            border: 2px solid #000;
            border-radius: 12px;
            font-weight: 700;
        }

        .form-control:focus {
            border-color: #FF9F43;
            box-shadow: none;
        }

        .route-box {
            background: #fff8f2;
            border-left: 4px solid #FF9F43;
            padding: 10px;
            border-radius: 0 8px 8px 0;
        }

        .info-label {
            font-weight: 800;
            text-transform: uppercase;
            font-size: 0.65rem;
            color: #666;
            display: block;
        }
    </style>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-black m-0 text-uppercase">🎟️ Booking Management</h2>
                <p class="text-muted fw-bold mb-0">Total Active Bookings: {{ $bookings->total() }}</p>
            </div>
        </div>

        <div class="filter-section p-4 mb-5 shadow-sm">
            <form method="GET" action="{{ route('admin.bookings.indexBook') }}" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="info-label mb-2">Search Passenger or Route</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="Enter name, email or city...">
                </div>

                <div class="col-md-4">
                    <label class="info-label mb-2">Filter by Status</label>
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="Confirmed" {{ request('status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="Ongoing" {{ request('status') == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <button class="btn btn-dark w-100 fw-black py-2 rounded-3 text-uppercase" style="background: #000;">
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>

        <div class="row g-4">
            @forelse($bookings as $booking)
                <div class="col-md-6 col-xl-4">
                    <div class="admin-card p-4 h-100 d-flex flex-column">

                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="info-label">Passenger</span>
                                <span class="fw-black h6">{{ $booking->user->name }}</span>
                            </div>
                            <span class="status-badge 
                                            @if($booking->status == 'Cancelled') bg-danger text-white 
                                            @elseif($booking->status == 'Completed') bg-success text-white
                                            @else bg-warning text-dark @endif">
                                {{ $booking->status }}
                            </span>
                        </div>

                        <div class="route-box mb-3">
                            <span class="info-label">Main Trip Route</span>
                            <div class="fw-bold small">{{ $booking->ride->pickup_address }} → {{ $booking->ride->drop_address }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <span class="info-label">Pickup At</span>
                                    <span class="fw-bold small">{{ $booking->pickup_address }}</span>
                                </div>
                                <div class="col-6">
                                    <span class="info-label">Drop At</span>
                                    <span class="fw-bold small">{{ $booking->drop_address }}</span>
                                </div>
                            </div>
                        </div>

                        <div
                            class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top border-dark border-opacity-10">
                            <div>
                                <span class="info-label">Booked On</span>
                                <span class="fw-bold small">{{ $booking->created_at->format('d M, Y') }}</span>
                            </div>
                            <div class="text-end">
                                <span class="info-label">Seats</span>
                                <span class="badge bg-dark rounded-pill">{{ $booking->seats_booked }}</span>
                            </div>
                        </div>

                        <div class="row g-2 mt-3">
                            <div class="col-6">
                                <a href="{{ route('admin.rides.show', $booking->ride->id) }}"
                                    class="btn btn-outline-dark w-100 fw-bold small py-2 rounded-3">
                                    View Ride
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('admin.userProfile', $booking->user->id) }}"
                                    class="btn btn-outline-dark w-100 fw-bold small py-2 rounded-3">
                                    View User
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h4 class="fw-black text-muted">No bookings found matching your criteria.</h4>
                </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $bookings->appends(request()->query())->links() }}
        </div>
    </div>
@endsection