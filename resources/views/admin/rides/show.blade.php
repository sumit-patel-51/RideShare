@extends('admin.layout.app')
@section('title', 'Ride Detail #' . $ride->id)

@section('content')
    <style>
        .detail-card {
            border: 3px solid #000;
            border-radius: 24px;
            background: #fff;
            box-shadow: 10px 10px 0px 0px #000;
            overflow: hidden;
        }

        .detail-header {
            background: #000;
            color: #fff;
            padding: 20px 30px;
        }

        .info-section {
            border-bottom: 2px dashed #eee;
            padding: 20px 0;
        }

        .info-section:last-child {
            border-bottom: none;
        }

        .label-custom {
            font-weight: 800;
            text-transform: uppercase;
            font-size: 0.7rem;
            color: #666;
            display: block;
            margin-bottom: 5px;
        }

        .value-custom {
            font-weight: 900;
            font-size: 1.1rem;
            color: #000;
        }

        .status-pill {
            border: 2px solid #000;
            font-weight: 900;
            padding: 5px 15px;
            border-radius: 10px;
            text-transform: uppercase;
            font-size: 0.75rem;
        }

        /* Passenger Table */
        .passenger-table thead {
            background: #f8f9fa;
            border-bottom: 2px solid #000;
        }

        .passenger-table th {
            font-weight: 900;
            text-transform: uppercase;
            font-size: 0.75rem;
        }
    </style>

    <div class="container py-4">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('admin.rides') }}" class="btn btn-outline-dark rounded-circle me-3"
                style="width: 40px; height: 40px;">←</a>
            <h3 class="fw-black m-0 text-uppercase">Ride Deep-Dive</h3>
        </div>

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="detail-card">
                    <div class="detail-header d-flex justify-content-between align-items-center">
                        <h5 class="fw-black m-0">TRIP ID: #{{ $ride->id }}</h5>
                        <span
                            class="status-pill {{ $ride->status == 'Cancelled' ? 'bg-danger text-white' : 'bg-warning text-dark' }}">
                            {{ $ride->status }}
                        </span>
                    </div>

                    <div class="card-body p-4">
                        <div class="info-section">
                            <div class="row">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <span class="label-custom">Pickup Point</span>
                                    <span class="value-custom">{{ $ride->pickup_address }}</span>
                                </div>
                                <div class="col-md-6">
                                    <span class="label-custom">Drop-off Point</span>
                                    <span class="value-custom">{{ $ride->drop_address }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="info-section">
                            <div class="row">
                                <div class="col-4">
                                    <span class="label-custom">Date</span>
                                    <span
                                        class="value-custom small">{{ \Carbon\Carbon::parse($ride->date)->format('D, M d, Y') }}</span>
                                </div>
                                <div class="col-4">
                                    <span class="label-custom">Time</span>
                                    <span class="value-custom small">{{ $ride->time }}</span>
                                </div>
                                <div class="col-4 text-end">
                                    <span class="label-custom">Fare</span>
                                    <span class="value-custom text-success">₹{{ $ride->price }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="info-section">
                            <span class="label-custom">Assigned Driver</span>
                            <div class="d-flex align-items-center mt-2">
                                <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center me-3"
                                    style="width: 45px; height: 45px; border: 2px solid #FF9F43;">
                                    {{ substr($ride->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <a href="{{ route('admin.userProfile', $ride->user->id) }}"
                                        class="fw-black text-dark text-decoration-none d-block">
                                        {{ $ride->user->name }}
                                    </a>
                                    <small class="text-muted fw-bold">📞 {{ $ride->user->phone }}</small>
                                </div>
                            </div>
                        </div>

                        @if($ride->status != 'Cancelled')
                            <div class="pt-4">
                                <form action="{{ route('admin.rides.cancel', $ride->id) }}" method="POST"
                                    onsubmit="return confirm('ADMIN WARNING: This will cancel the ride for the driver and all booked passengers. Continue?')">
                                    @csrf
                                    <button
                                        class="btn btn-danger w-100 fw-black py-3 rounded-4 shadow-sm border-2 border-dark text-uppercase">
                                        Force Cancel Ride
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="detail-card h-100">
                    <div class="p-4">
                        <h5 class="fw-black mb-4">👥 PASSENGER MANIFEST</h5>

                        <div class="table-responsive">
                            <table class="table passenger-table align-middle">
                                <thead>
                                    <tr>
                                        <th>Passenger</th>
                                        <th class="text-center">Seats</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($ride->bookings as $booking)
                                        <tr>
                                            <td>
                                                <div class="fw-bold small text-dark">{{ $booking->user->name }}</div>
                                                <small class="text-muted"
                                                    style="font-size: 10px;">{{ $booking->user->email }}</small>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-dark rounded-pill">{{ $booking->seats_booked }}</span>
                                            </td>
                                            <td>
                                                <small
                                                    class="fw-black text-uppercase {{ $booking->status == 'Cancelled' ? 'text-danger' : 'text-success' }}"
                                                    style="font-size: 10px;">
                                                    {{ $booking->status }}
                                                </small>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-4 text-muted fw-bold">
                                                No bookings for this ride yet.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 p-3 rounded-4 bg-light border border-dark border-opacity-10">
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold small">Total Capacity:</span>
                                <span
                                    class="fw-black">{{ $ride->available_seats + $ride->bookings->where('status', '!=', 'Cancelled')->sum('seats_booked') }}
                                    Seats</span>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <span class="fw-bold small">Booked:</span>
                                <span class="fw-black text-orange"
                                    style="color: #FF9F43;">{{ $ride->bookings->where('status', '!=', 'Cancelled')->sum('seats_booked') }}
                                    Seats</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection