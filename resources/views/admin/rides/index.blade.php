@extends('admin.layout.app')
@section('title', 'Ride Management')

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

        .route-header {
            background: #000;
            color: #fff;
            margin: -1rem -1rem 1rem -1rem;
            padding: 1rem;
            border-radius: 15px 15px 0 0;
        }

        .info-label {
            font-weight: 800;
            text-transform: uppercase;
            font-size: 0.65rem;
            color: #666;
            display: block;
        }

        .form-control,
        .form-select {
            border: 2px solid #000;
            border-radius: 12px;
            font-weight: 700;
        }

        /* Custom Pagination Styling */
        .custom-admin-pagination .page-item .page-link {
            border: 2px solid #000;
            border-radius: 8px;
            margin: 0 3px;
            font-weight: 800;
            color: #000;
        }

        .custom-admin-pagination .page-item.active .page-link {
            background-color: #FF9F43;
            border-color: #000;
            color: #000;
        }
    </style>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-black m-0 text-uppercase">🚗 Ride Management</h2>
                <p class="text-muted fw-bold mb-0">Total Rides in System: {{ $rides->total() }}</p>
            </div>
        </div>

        <div class="p-4 mb-5 shadow-sm" style="border: 3px solid #000; border-radius: 20px; background: #f8f9fa;">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="info-label mb-2">Search Route or Driver</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="E.g. Mumbai, John Doe...">
                </div>

                <div class="col-md-4">
                    <label class="info-label mb-2">Ride Status</label>
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <button class="btn btn-dark w-100 fw-black py-2 rounded-3 text-uppercase">Apply Filters</button>
                </div>
            </form>
        </div>

        <div class="row g-4">
            @forelse($rides as $ride)
                <div class="col-md-6 col-xl-4">
                    <div class="admin-card p-3 h-100 d-flex flex-column">

                        <div class="route-header d-flex justify-content-between align-items-center">
                            <span class="fw-bold small text-truncate">{{ $ride->pickup_address }} →
                                {{ $ride->drop_address }}</span>
                            <span
                                class="status-badge {{ $ride->status == 'Cancelled' ? 'bg-danger' : 'bg-success' }} text-white">
                                {{ $ride->status }}
                            </span>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-7">
                                <span class="info-label">Driver</span>
                                <span class="fw-black">{{ $ride->user->name }}</span>
                            </div>
                            <div class="col-5 text-end">
                                <span class="info-label">Fare</span>
                                <span class="fw-black text-success">₹{{ $ride->price }}</span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between p-2 rounded-3 mb-4"
                            style="background: #f1f1f1; border: 1px solid #000;">
                            <div class="text-center flex-fill border-end border-dark border-opacity-25">
                                <span class="info-label">Seats</span>
                                <span class="fw-bold">🪑 {{ $ride->available_seats }}</span>
                            </div>
                            <div class="text-center flex-fill">
                                <span class="info-label">Passengers</span>
                                <span class="fw-bold">👥 {{ $ride->bookings->count() }}</span>
                            </div>
                        </div>

                        <div class="mt-auto">
                            <a href="{{ route('admin.rides.show', $ride->id) }}"
                                class="btn btn-dark w-100 fw-bold mb-2 rounded-3">
                                View Trip Details
                            </a>

                            @if($ride->status != 'Cancelled')
                                <form action="{{ route('admin.rides.cancel', $ride->id) }}" method="POST"
                                    onsubmit="return confirm('ADMIN ACTION: This will notify the driver and all passengers. Proceed?')">
                                    @csrf
                                    <button class="btn btn-outline-danger w-100 fw-bold rounded-3">
                                        Cancel This Ride
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h4 class="fw-black text-muted">No rides matching your search were found.</h4>
                </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center custom-admin-pagination">
            {{ $rides->appends(request()->query())->links() }}
        </div>

    </div>
@endsection