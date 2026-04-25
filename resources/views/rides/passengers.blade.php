@extends('layouts.dashboard')

@section('title', 'Passenger List')

@section('content')
<style>
    /* Styling the route indicator for professional look */
    .route-wrapper {
        position: relative;
        padding-left: 20px;
        border-left: 2px solid #000;
    }
    .route-marker {
        position: absolute;
        left: -7px;
        width: 12px;
        height: 12px;
        border: 2px solid #000;
        border-radius: 50%;
        background: #fff;
    }
    .marker-pickup { top: 0; background: #FF9F43; }
    .marker-drop { bottom: 0; background: #000; }
</style>

<div class="container py-2 py-md-4">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('rides.my') }}" class="btn btn-outline-dark rounded-circle me-3 d-flex align-items-center justify-content-center"
            style="width: 40px; height: 40px; border-width: 2px; flex-shrink: 0;">
            ←
        </a>
        <div class="overflow-hidden">
            <h3 class="fw-black mb-0 text-truncate">Passenger List</h3>
            <p class="text-muted small mb-0 text-truncate">{{ $ride->pickup_address }} to {{ $ride->drop_address }}</p>
        </div>
    </div>

    @if($bookings->count() > 0)
        <div class="row g-3">
            @foreach($bookings as $booking)
                <div class="col-12 col-xl-6">
                    <div class="card border-2 border-dark rounded-4 shadow-sm bg-white h-100">
                        <div class="card-body p-3 p-md-4 d-flex flex-column justify-content-between">
                            
                            <div class="d-flex align-items-center mb-4">
                                <div class="flex-shrink-0 me-3">
                                    @if ($booking->user->image)
                                        <img src="{{ asset('userImages/' . $booking->user->image) }}"
                                            class="rounded-circle border-2 border-dark"
                                            style="width: 55px; height: 55px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle border-2 border-dark d-flex align-items-center justify-content-center bg-light"
                                            style="width: 55px; height: 55px; background-color: #FF9F43 !important;">
                                            <span class="fw-black fs-4">{{ substr($booking->user->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex-grow-1 overflow-hidden">
                                    <div class="d-flex justify-content-between align-items-start gap-2">
                                        <h5 class="fw-black mb-1 text-truncate">{{ $booking->user->name }}</h5>
                                        <span class="badge border border-dark text-dark rounded-pill px-2 py-1 flex-shrink-0"
                                            style="background-color: #FF9F43; font-size: 10px; font-weight: 800;">
                                            {{ $booking->seats_booked }} SEATS
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column flex-sm-row gap-1 gap-sm-3">
                                        <span class="text-muted small fw-bold text-nowrap">📞 {{ $booking->user->phone }}</span>
                                        <span class="text-muted small fw-bold text-truncate">✉️ {{ $booking->user->email }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="route-wrapper ms-2 mb-4">
                                <div class="route-marker marker-pickup"></div>
                                <div class="mb-3">
                                    <small class="text-muted fw-bold text-uppercase d-block" style="font-size: 10px; letter-spacing: 0.5px;">Pickup Point</small>
                                    <span class="fw-bold small text-dark d-block">{{ $booking->pickup_address }}</span>
                                </div>
                                <div class="route-marker marker-drop"></div>
                                <div>
                                    <small class="text-muted fw-bold text-uppercase d-block" style="font-size: 10px; letter-spacing: 0.5px;">Dropoff Point</small>
                                    <span class="fw-bold small text-dark d-block">{{ $booking->drop_address }}</span>
                                </div>
                            </div>

                            <div class="mt-auto pt-3 border-top border-1 border-light d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-uppercase small text-dark">
                                    Status: <span class="text-success">{{ $booking->status }}</span>
                                </span>
                                <a href="tel:{{ $booking->user->phone }}"
                                    class="btn btn-dark btn-sm rounded-pill px-4 fw-bold shadow-sm">
                                    Call Now
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5 border-2 border-dark border-dashed rounded-5 mt-4 bg-white">
            <h5 class="text-muted fw-bold">Waiting for passengers...</h5>
            <p class="text-muted">Once someone books a seat, they will appear here.</p>
        </div>
    @endif
</div>
@endsection