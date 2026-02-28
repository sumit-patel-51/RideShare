@extends('layouts.dashboard')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom border-2 border-dark">
            <h3 class="fw-bolder m-0">My Bookings</h3>
            <span class="badge bg-dark rounded-pill px-3">{{ $bookings->count() }} active</span>
        </div>

        @if($bookings->count() > 0)
            <div class="row g-4">
                @foreach($bookings as $booking)
                    <div class="col-12 col-md-6">
                        <div class="card border-2 border-dark rounded-4 shadow-sm h-100 bg-white">
                            <div class="card-body p-4">

                                <div class="d-flex justify-content-between align-items-start mb-4">
                                    <div>
                                        <p class="text-muted small fw-bold mb-0 text-uppercase letter-spacing-1">Driver</p>
                                        <h5 class="fw-bold mb-0 text-dark">{{ $booking->ride->user->name }}</h5>
                                    </div>
                                    <span class="badge border border-dark text-dark px-3 py-2 rounded-3"
                                        style="background-color: #FF9F43; font-weight: 800;">
                                        {{ strtoupper($booking->status) }}
                                    </span>
                                </div>

                                <div class="ps-3 border-start border-2 border-dark position-relative mb-4">
                                    <div class="mb-3">
                                        <div class="fw-bold text-dark">{{ $booking->ride->pickup_address }}</div>
                                        <small
                                            class="text-muted">{{ \Carbon\Carbon::parse($booking->ride->date)->format('M d, Y') }}</small>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $booking->ride->drop_address }}</div>
                                        <small class="text-muted">{{ $booking->ride->time }}</small>
                                    </div>
                                </div>

                                <div
                                    class="d-flex justify-content-between align-items-center pt-3 border-top border-1 border-light">
                                    <div>
                                        <span class="text-muted small d-block">Fare</span>
                                        <span class="h4 fw-black mb-0">${{ number_format($booking->ride->price, 2) }}</span>
                                    </div>
                                    <div>
                                        @if($booking->status == 'Confirmed')
                                            <form method="POST" action="{{ route('booking.cancel', $booking->id) }}">
                                                @csrf
                                                <button class="btn btn-danger btn-sm">
                                                    Cancel
                                                </button>
                                            </form>
                                        @else
                                            <span class="badge bg-secondary">Cancelled</span>
                                        @endif
                                    </div>
                                    <a href="#" class="btn btn-dark fw-bold px-4 rounded-pill">Details</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5 border border-dashed rounded-5 mt-4">
                <h5 class="text-secondary fw-bold">No Bookings Yet</h5>
                <p class="text-muted">Explore rides and book your first trip today!</p>
                <a href="/dashboard" class="btn btn-dark btn-lg px-5 mt-2 rounded-pill shadow"
                    style="background-color: #FF9F43; border: none; color: black;">
                    Find a Ride
                </a>
            </div>
        @endif
    </div>
@endsection