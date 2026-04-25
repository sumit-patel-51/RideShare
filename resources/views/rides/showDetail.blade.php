@extends('layouts.dashboard')

@section('title', 'Ride Detail')

@section('content')
<style>
    .booking-card {
        border: 2px solid #000000;
        border-radius: 24px;
        box-shadow: 8px 8px 0px 0px rgba(0,0,0,1);
        background: #ffffff;
        overflow: hidden;
    }
    .info-label {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.7rem;
        color: #666;
        display: block;
    }
    .info-value {
        font-weight: 800;
        font-size: 1.1rem;
        color: #000;
    }
    .form-control {
        border: 2px solid #000;
        border-radius: 12px;
        padding: 12px;
    }
    .form-control:focus {
        border-color: #FF9F43;
        box-shadow: none;
    }
</style>

<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-dark rounded-circle me-3" style="width: 40px; height: 40px;">←</a>
        <h3 class="fw-black m-0">Confirm Booking</h3>
    </div>

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="booking-card p-4 h-100">
                <h5 class="fw-black mb-4 pb-2 border-bottom border-2 border-dark">Ride Details</h5>
                
                <div class="mb-4">
                    <span class="info-label">Route</span>
                    <span class="info-value">{{ $ride->pickup_address }}</span>
                    <div class="text-muted my-1 ms-2">↓</div>
                    <span class="info-value">{{ $ride->drop_address }}</span>
                </div>

                <div class="row mb-4">
                    <div class="col-6">
                        <span class="info-label">Date</span>
                        <span class="info-value small text-nowrap">{{ \Carbon\Carbon::parse($ride->date)->format('D, M d') }}</span>
                    </div>
                    <div class="col-6">
                        <span class="info-label">Time</span>
                        <span class="info-value small">{{ $ride->time }}</span>
                    </div>
                </div>

                <div class="p-3 rounded-4 mb-4" style="background: #f8f9fa; border: 1px dashed #000;">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Fare per seat</span>
                        <span class="h4 fw-black mb-0 text-success">₹{{ $ride->price }}</span>
                    </div>
                </div>

                <h6 class="info-label mb-3">Driver Information</h6>
                <div class="d-flex align-items-center p-2 border-2 border-dark rounded-4">
                    @if ($ride->user->image)
                        <img src="{{ asset('userImages/' . $ride->user->image) }}" class="rounded-circle border-2 border-dark me-3" style="width: 50px; height: 50px; object-fit: cover;">
                    @else
                        <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; border: 2px solid #FF9F43;">
                            {{ substr($ride->user->name, 0, 1) }}
                        </div>
                    @endif
                    <div>
                        <a href="{{ route('profile.show', $ride->user->id) }}" class="fw-black text-black text-decoration-none d-block">{{ $ride->user->name }}</a>
                        <span class="text-muted small">⭐ {{ round($avgRating, 1) ?? 'N/A' }} Rating</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="booking-card p-4 p-md-5">
                <h4 class="fw-black mb-4">📝 Complete Your Request</h4>
                
                <form action="{{ route('rides.book', $ride) }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="fw-bold small text-uppercase mb-2">Your Pickup Point</label>
                        <input type="text" name="pickup_address" class="form-control" placeholder="Where should the driver meet you?" required>
                        <small class="text-muted">Can be different from the main pickup address.</small>
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold small text-uppercase mb-2">Your Dropoff Point</label>
                        <input type="text" name="drop_address" class="form-control" placeholder="Where do you want to get off?" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="fw-bold small text-uppercase mb-2">Number of Seats</label>
                            <input type="number" name="seats_booked" class="form-control" min="1" max="{{ $ride->available_seats }}" value="1" required>
                            <small class="text-muted">{{ $ride->available_seats }} seats available</small>
                        </div>
                    </div>

                    <div class="mt-4 pt-2">
                        <button class="btn btn-dark w-100 fw-black py-3 text-uppercase" 
                                style="background-color: #FF9F43; border: 2px solid #000; color: #000; letter-spacing: 1px;"
                                onclick="return confirm('Confirm this booking for ₹{{ $ride->price }}?')">
                            Confirm My Seat
                        </button>
                    </div>
                    <p class="text-center mt-3 text-muted small fw-bold">No payment is required right now.</p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection