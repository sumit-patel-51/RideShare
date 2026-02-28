@extends('layouts.dashboard')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom border-2 border-dark">
            <div>
                <h3 class="fw-black m-0">My Posted Rides</h3>
                <p class="text-muted small mb-0">Manage your active routes and seat availability</p>
            </div>
            <a href="/rides/create" class="btn btn-dark fw-bold px-4 rounded-pill"
                style="background-color: #FF9F43; border: 2px solid #000; color: black;">
                + POST NEW RIDE
            </a>
        </div>

        @if($rides->count() > 0)
            <div class="row g-4">
                @foreach($rides as $ride)
                    <div class="col-12">
                        <div class="card border-2 border-dark rounded-4 shadow-sm overflow-hidden">
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    <div class="col-md-5 p-4 bg-white border-end border-1 border-light">
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="badge bg-dark rounded-pill me-2 px-3">ACTIVE</span>
                                            <small
                                                class="text-muted fw-bold">{{ \Carbon\Carbon::parse($ride->date)->format('M d, Y') }}</small>
                                        </div>
                                        <h5 class="fw-black mb-1">{{ $ride->pickup_address }}</h5>
                                        <div class="text-muted my-1 ms-2">↓</div>
                                        <h5 class="fw-black">{{ $ride->drop_address }}</h5>
                                    </div>

                                    <div
                                        class="col-md-4 p-4 bg-light d-flex align-items-center justify-content-around text-center border-end border-1 border-light">
                                        <div>
                                            <p class="text-muted small fw-bold mb-0">PRICE</p>
                                            <span class="h4 fw-black text-dark">₹{{ $ride->price }}</span>
                                        </div>
                                        <div>
                                            <p class="text-muted small fw-bold mb-0">SEATS LEFT</p>
                                            <span class="h4 fw-black text-dark">{{ $ride->available_seats }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 p-4 d-flex flex-column justify-content-center bg-white">
                                        @if ($ride->status == "Cancelled")
                                            <p class="">Cancelled</p>
                                        @else
                                            <a href="{{ route('ride.passengers', $ride) }}"
                                                class="btn btn-outline-dark fw-bold mb-2 rounded-3">View Passengers</a>
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-sm btn-dark flex-grow-1">Edit</button>
                                                <form action="{{ route('ride.cancelRide', $ride) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger flex-grow-1">Cancel</button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5 border border-dashed rounded-5 mt-4">
                <div class="mb-3 display-6">🚗</div>
                <h5 class="text-secondary fw-bold">You haven't shared your car yet.</h5>
                <p class="text-muted">Start earning by sharing your ride with others heading your way.</p>
                <a href="/rides/create" class="btn btn-dark btn-lg px-5 mt-2 rounded-pill shadow"
                    style="background-color: #FF9F43; border: none; color: black;">
                    Post Your First Ride
                </a>
            </div>
        @endif
    </div>
@endsection