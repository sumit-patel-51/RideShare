@extends('layouts.dashboard')

@section('content')
    <div class="container py-4">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('rides.my') }}" class="btn btn-outline-dark rounded-circle me-3"
                style="width: 40px; height: 40px; border-width: 2px;">
                ←
            </a>
            <div>
                <h3 class="fw-black mb-0">Passenger List</h3>
                <p class="text-muted small mb-0">{{ $ride->pickup_address }} to {{ $ride->drop_address }}</p>
            </div>
        </div>

        @if($bookings->count() > 0)
            <div class="row g-3">
                @foreach($bookings as $booking)
                    <div class="col-12 col-lg-6">
                        <div class="card border-2 border-dark rounded-4 shadow-sm bg-white overflow-hidden">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="rounded-circle border border-dark d-flex align-items-center justify-content-center bg-light"
                                            style="width: 60px; height: 60px; background-color: #FF9F43 !important;">
                                            <span class="fw-black fs-4">{{ substr($booking->user->name, 0, 1) }}</span>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <h5 class="fw-black mb-1">{{ $booking->user->name }}</h5>
                                            <span class="badge border border-dark text-dark rounded-pill px-3 py-2"
                                                style="background-color: #FF9F43; font-size: 10px;">
                                                {{ $booking->seats_booked }} SEATS
                                            </span>
                                        </div>
                                        <div class="d-flex flex-wrap gap-2">
                                            <span class="text-muted small fw-bold">📞 {{ $booking->user->phone }}</span>
                                            <span class="text-muted small fw-bold">✉️ {{ $booking->user->email }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="mt-4 pt-3 border-top border-1 border-light d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-uppercase small text-dark">Status: <span
                                            class="text-success">{{ $booking->status }}</span></span>
                                    <div>
                                        <a href="tel:{{ $booking->user->phone }}"
                                            class="btn btn-dark btn-sm rounded-pill px-4 fw-bold">Call Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5 border border-dashed rounded-5 mt-4">
                <h5 class="text-muted fw-bold">Waiting for passengers...</h5>
                <p class="text-muted">Once someone books a seat, they will appear here.</p>
            </div>
        @endif
    </div>
@endsection