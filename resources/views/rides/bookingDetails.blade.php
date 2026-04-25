@extends('layouts.dashboard')

@section('title', 'Booking Details')

@section('content')
    <style>
        .booking-detail-card {
            border: 2px solid #000000;
            border-radius: 24px;
            background: #ffffff;
            box-shadow: 8px 8px 0px 0px rgba(0, 0, 0, 1);
            overflow: hidden;
        }

        .status-banner {
            background-color: #000;
            color: #fff;
            padding: 10px;
            text-align: center;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .status-banner.completed {
            background-color: #28a745;
        }

        .status-banner.cancelled {
            background-color: #dc3545;
        }

        .status-banner.pending {
            background-color: #FF9F43;
            color: #000;
        }

        .info-label {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.65rem;
            color: #666;
            display: block;
            margin-bottom: 2px;
        }

        .info-value {
            font-weight: 800;
            font-size: 1rem;
            color: #000;
        }

        .section-divider {
            border-top: 2px dashed #000;
            opacity: 0.1;
            margin: 20px 0;
        }

        /* Professional Route Styling */
        .route-visual {
            position: relative;
            padding-left: 20px;
            border-left: 2px solid #000;
        }

        .route-dot {
            position: absolute;
            left: -7px;
            width: 12px;
            height: 12px;
            border: 2px solid #000;
            background: #fff;
            border-radius: 50%;
        }

        .dot-top {
            top: 0;
            background: #FF9F43;
        }

        .dot-bottom {
            bottom: 0;
            background: #000;
        }
    </style>

    <div class="container py-2 py-md-4">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('rides.bookings') }}"
                class="btn btn-outline-dark rounded-circle me-3 d-flex align-items-center justify-content-center"
                style="width: 35px; height: 35px; border-width: 2px;">←</a>
            <h4 class="fw-black mb-0">Booking Summary</h4>
        </div>

        <div class="booking-detail-card mx-auto" style="max-width: 800px;">
            <div class="status-banner {{ strtolower($booking->ride->status) }}">
                Ride {{ $booking->ride->status }}
            </div>

            <div class="card-body p-3 p-md-5">
                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-6">
                        <span class="info-label">From</span>
                        <span class="info-value d-block text-truncate">{{ $booking->ride->pickup_address }}</span>
                    </div>
                    <div class="col-6 col-md-6 text-end">
                        <span class="info-label">To</span>
                        <span class="info-value d-block text-truncate">{{ $booking->ride->drop_address }}</span>
                    </div>
                </div>

                <div class="bg-light p-3 rounded-4 mb-4 border border-1 border-dark border-opacity-10">
                    <div class="route-visual ms-2">
                        <div class="route-dot dot-top"></div>
                        <div class="mb-3">
                            <span class="info-label">Your Pickup</span>
                            <span class="info-value small">{{ $booking->pickup_address }}</span>
                        </div>
                        <div class="route-dot dot-bottom"></div>
                        <div>
                            <span class="info-label">Your Dropoff</span>
                            <span class="info-value small">{{ $booking->drop_address }}</span>
                        </div>
                    </div>
                </div>

                <div class="row g-3 text-center text-md-start">
                    <div class="col-4">
                        <span class="info-label">Date</span>
                        <span
                            class="info-value small">{{ \Carbon\Carbon::parse($booking->ride->date)->format('M d, y') }}</span>
                    </div>
                    <div class="col-4">
                        <span class="info-label">Time</span>
                        <span class="info-value small">{{ $booking->ride->time }}</span>
                    </div>
                    <div class="col-4 text-end">
                        <span class="info-label">Total Fare</span>
                        <span class="info-value text-success h5 mb-0">₹{{ number_format($booking->ride->price * $booking->seats_booked,2) }}</span>
                    </div>
                </div>

                <div class="section-divider"></div>

                <div class="row align-items-center g-3">
                    <div class="col-12 col-md-8">
                        <h6 class="fw-black mb-3 text-uppercase small" style="letter-spacing: 1px;">Driver Details</h6>
                        <div class="d-flex align-items-center">
                            @if ($booking->ride->user->image)
                                <img src="{{ asset('userImages/' . $booking->ride->user->image) }}"
                                    class="rounded-circle border-2 border-dark me-3"
                                    style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center me-3 shadow-sm"
                                    style="width: 50px; height: 50px; border: 2px solid #FF9F43;">
                                    {{ substr($booking->ride->user->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <a href="{{ route('profile.show', $booking->ride->user->id) }}"
                                    class="fw-bold text-black d-block text-decoration-none">{{ $booking->ride->user->name }}</a>
                                <span class="text-muted small">⭐ {{ round($avgRating, 1) ?? 'N/A' }} Rating</span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="info-label">Contact Driver</span>
                            <a href="tel:{{ $booking->ride->user->phone }}"
                                class="btn btn-sm btn-outline-dark fw-bold rounded-pill px-3 mt-1">📞
                                {{ $booking->ride->user->phone }}</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 text-md-end">
                        <span class="info-label">Seats Booked</span>
                        <span class="badge bg-dark px-3 py-2 rounded-3">{{ $booking->seats_booked }} Seat(s)</span>
                    </div>
                </div>

                <div class="mt-4 mt-md-5">
                    @if($booking->ride->status == 'Completed' && !$alreadyRated)
                        <div class="p-3 p-md-4 rounded-4 border-2 border-dark bg-white shadow-sm">
                            <h5 class="fw-black mb-3">Rate your experience</h5>
                            <form action="{{ route('ride.rate', $booking->ride->id) }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12 col-md-4">
                                        <select name="rating" class="form-select border-2 border-dark rounded-3 p-3" required>
                                            <option value="">Choose Rating</option>
                                            <option value="5">5 Stars - Excellent</option>
                                            <option value="4">4 Stars - Good</option>
                                            <option value="3">3 Stars - Average</option>
                                            <option value="2">2 Stars - Poor</option>
                                            <option value="1">1 Star - Terrible</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <textarea name="review" class="form-control border-2 border-dark rounded-3 p-3"
                                            placeholder="Optional: How was the driver?"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn w-100 fw-black py-3 rounded-3"
                                            style="background-color: #FF9F43; border: 2px solid #000; color: #000;">SUBMIT
                                            REVIEW</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @elseif($alreadyRated)
                        <div class="alert alert-success border-2 border-dark rounded-4 fw-bold shadow-sm">
                            ✅ Feedback submitted.
                        </div>
                    @endif

                    @if($booking->ride->status != 'Completed' && $booking->ride->status != 'Cancelled' && $booking->status != "Cancelled")
                        <form action="{{ route('booking.cancel', $booking->id)}}" method="POST" class="mt-3">
                            @csrf
                            <button class="btn btn-outline-danger w-100 fw-bold border-2 py-3 rounded-4"
                                onclick="return confirm('Cancel this booking?')">
                                CANCEL BOOKING
                            </button>
                        </form>
                    @endif

                    @if ($booking->status == "Cancelled")
                        <div class="w-100 text-center py-3 rounded-4 border-2 border-danger text-danger fw-black text-uppercase shadow-sm mt-3"
                            style="background-color: #fff5f5; letter-spacing: 1px;">
                            Cancelled
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection