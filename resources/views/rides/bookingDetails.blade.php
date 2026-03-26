@extends('layouts.dashboard')

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
            font-size: 0.7rem;
            color: #666;
            display: block;
            margin-bottom: 2px;
        }

        .info-value {
            font-weight: 800;
            font-size: 1.1rem;
            color: #000;
        }

        .section-divider {
            border-top: 2px dashed #eee;
            margin: 20px 0;
        }

        .rating-star-select {
            border: 2px solid #000;
            border-radius: 12px;
            font-weight: 700;
        }
    </style>
    <div class="container py-4">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('rides.bookings') }}" class="btn btn-outline-dark rounded-circle me-3"
                style="width: 40px; height: 40px;">←</a>
            <h3 class="fw-black mb-0">Booking Summary</h3>
        </div>

        <div class="booking-detail-card mx-auto" style="max-width: 800px;">
            <div class="status-banner {{ strtolower($booking->ride->status) }}">
                Ride {{ $booking->ride->status }}
            </div>

            <div class="card-body p-4 p-md-5">
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <span class="info-label">From</span>
                        <span class="info-value">{{ $booking->ride->pickup_address }}</span>
                    </div>
                    <div class="col-md-6 mb-3 text-md-end">
                        <span class="info-label">To</span>
                        <span class="info-value">{{ $booking->ride->drop_address }}</span>
                    </div>
                    <div class="col-md-4">
                        <span class="info-label">Date</span>
                        <span
                            class="info-value">{{ \Carbon\Carbon::parse($booking->ride->date)->format('D, M d Y') }}</span>
                    </div>
                    <div class="col-md-4">
                        <span class="info-label">Time</span>
                        <span class="info-value">{{ $booking->ride->time }}</span>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <span class="info-label">Total Fare</span>
                        <span class="info-value text-success" style="font-size: 1.5rem;">₹{{ $booking->ride->price }}</span>
                    </div>
                </div>

                <div class="section-divider"></div>

                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="fw-black mb-3">Driver Details</h5>
                        <div class="d-flex align-items-center">

                            @if ($booking->ride->user->image)
                                <img src="{{ asset('userImages/' . $booking->ride->user->image) }}"
                                    class="rounded-circle border border-3 border-dark me-3"
                                    style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center me-3"
                                    style="width: 50px; height: 50px; border: 2px solid #FF9F43;">
                                    {{ substr($booking->ride->user->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <a href="{{ route('profile.show', $booking->ride->user->id) }}"
                                    class="fw-bold text-black d-block">{{ $booking->ride->user->name }}</a>
                                <span class="text-muted small">⭐ {{ round($avgRating, 1) ?? 'N/A' }} Rating</span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="info-label">Contact Number</span>
                            <a href="tel:{{ $booking->ride->user->phone }}"
                                class="text-dark fw-bold text-decoration-none">📞 {{ $booking->ride->user->phone }}</a>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <span class="info-label">Seats Booked</span>
                        <span class="badge bg-dark px-3 py-2 fs-6">{{ $booking->seats_booked }} Seat(s)</span>
                    </div>
                </div>

                <div class="mt-5">
                    @if($booking->ride->status == 'Completed' && !$alreadyRated)
                        <div class="px-4 rounded-4 border-2 border-dark">
                            <h5 class="fw-black mb-3">How was your trip?</h5>
                            <form action="{{ route('ride.rate', $booking->ride->id) }}" method="POST">
                                @csrf
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <select name="rating" class="form-select rating-star-select p-3" required>
                                            <option value="">Choose Rating</option>
                                            <option value="5">5 Stars - Excellent</option>
                                            <option value="4">4 Stars - Good</option>
                                            <option value="3">3 Stars - Average</option>
                                            <option value="2">2 Stars - Poor</option>
                                            <option value="1">1 Star - Terrible</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <textarea name="review" class="form-control border-dark rounded-4 p-2"
                                            placeholder="Tell us about the ride..."></textarea>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button class="btn w-100 fw-black py-3"
                                            style="background-color: #FF9F43; border: 2px solid #000;">SUBMIT REVIEW</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @elseif($alreadyRated)
                        <div class="alert alert-success border-2 border-dark rounded-4 fw-bold">
                            ✅ You've shared your feedback for this Driver.
                        </div>
                    @endif

                    @if($booking->ride->status != 'Completed' && $booking->ride->status != 'Cancelled' && $booking->status != "Cancelled")
                        <form action="{{ route('booking.cancel', $booking->id)}}" method="POST" class="mt-3">
                            @csrf
                            <button class="btn btn-outline-danger w-100 fw-bold border-2 py-3 rounded-4"
                                onclick="return confirm('Are you sure you want to cancel?')">
                                CANCEL BOOKING
                            </button>
                        </form>
                    @endif
                    @if ($booking->status == "Cancelled")
                        <div class="w-100 text-center py-3 rounded-4 border-2 border-danger text-danger fw-black text-uppercase shadow-sm"
                            style="background-color: #fff5f5; letter-spacing: 1px;">
                            Cancelled
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection