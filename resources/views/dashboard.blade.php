@extends('layouts.dashboard')

@section('content')
    <div class="container py-4">
        <h3 class="fw-black mb-4">Available Rides</h3>

        <div class="card border-2 border-dark rounded-4 shadow-sm mb-5">
            <div class="card-body p-4">
                <form method="GET" action="{{ route('dashboard') }}" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-uppercase">Pickup</label>
                        <input type="text" name="pickup" class="form-control border-dark" id="pickup"
                            placeholder="Enter city" value="{{ request('pickup') }}">
                    </div>

                    <div class="col-md-1 d-none d-md-flex align-items-center justify-content-center pt-4">
                        <button type="button" onclick="swap()" class="btn btn-outline-dark rounded-circle border-2 p-2"
                            style="width: 40px; height: 40px; line-height: 1;">
                            ⇄
                        </button>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-uppercase">Dropoff</label>
                        <input type="text" name="drop" class="form-control border-dark" id="drop" placeholder="Enter city"
                            value="{{ request('drop') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-uppercase">Date</label>
                        <input type="date" name="date" class="form-control border-dark" value="{{ request('date') }}">
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-dark w-100 fw-bold py-2"
                            style="background-color: #FF9F43; border: 2px solid #000; color: #000;">
                            SEARCH
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if($rides->count() > 0)
            <div class="row">
                @foreach($rides as $ride)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card border-2 border-dark rounded-4 h-100 shadow-sm bg-white overflow-hidden">
                            <div class="card-header bg-dark text-white p-3 border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">{{ $ride->pickup_address }}</span>
                                    <span class="mx-2">→</span>
                                    <span class="fw-bold">{{ $ride->drop_address }}</span>
                                </div>
                            </div>

                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <p class="text-muted small mb-0 fw-bold">DATE & TIME</p>
                                        <p class="fw-bold mb-0">{{ $ride->date }} | {{ $ride->time }}</p>
                                    </div>
                                    <div class="text-end">
                                        <p class="text-muted small mb-0 fw-bold">PRICE</p>
                                        <p class="h4 fw-black mb-0 text-success">₹{{ $ride->price }}</p>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center p-3 rounded-3 mb-4"
                                    style="background: #f8f9fa; border: 1px solid #ddd;">
                                    <div class="flex-grow-1">
                                        <small class="text-muted d-block fw-bold text-uppercase"
                                            style="font-size: 10px;">Driver</small>
                                        <span class="fw-bold text-dark">{{ $ride->user->name }}</span>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-dark rounded-pill">{{ $ride->available_seats }} Seats Left</span>
                                    </div>
                                </div>

                                <form action="{{ route('rides.book', $ride->id) }}" method="POST">
                                    @csrf
                                    <button class="btn w-100 fw-black py-2 rounded-3 text-uppercase"
                                        style="background-color: #FF9F43; border: 2px solid #000; color: #000;">
                                        Book This Ride
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5 border border-dashed rounded-5 mt-4">
                <h5 class="text-muted fw-bold">No rides found for your search.</h5>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-dark mt-3">Reset Filters</a>
            </div>
        @endif
    </div>

    <script>
        function swap() {
            const box1 = document.getElementById("pickup");
            const box2 = document.getElementById("drop");
            let temp = box1.value;
            box1.value = box2.value;
            box2.value = temp;
        }
    </script>
@endsection