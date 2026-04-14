@extends('layouts.dashboard')

@section('content')
<style>
    /* Styling for the swap button on mobile */
    @media (max-width: 767.98px) {
        .swap-container {
            text-align: center;
            margin: -10px 0;
            z-index: 2;
        }
        .swap-btn {
            transform: rotate(90deg);
            background: #fff !important;
        }
    }
</style>

<div class="container py-2 py-md-4">
    <h3 class="fw-black mb-4 px-1">Available Rides</h3>

    <div class="card border-2 border-dark rounded-4 shadow-sm mb-5 bg-white">
        <div class="card-body p-3 p-md-4">
            <form method="GET" action="{{ route('dashboard') }}" class="row g-2 g-md-3 align-items-end">
                <div class="col-12 col-md-3">
                    <label class="form-label small fw-bold text-uppercase mb-1">Pickup</label>
                    <input type="text" name="pickup" class="form-control border-dark py-2" id="pickup"
                        placeholder="Enter Address" value="{{ request('pickup') }}">
                </div>

                <div class="col-12 col-md-1 swap-container d-flex align-items-center justify-content-center">
                    <button type="button" onclick="swap()" class="btn btn-outline-dark rounded-circle border-2 p-0 swap-btn shadow-sm"
                        style="width: 40px; height: 40px; line-height: 40px; display: flex; align-items: center; justify-content: center;">
                        ⇄
                    </button>
                </div>

                <div class="col-12 col-md-3">
                    <label class="form-label small fw-bold text-uppercase mb-1">Dropoff</label>
                    <input type="text" name="drop" class="form-control border-dark py-2" id="drop" 
                        placeholder="Enter Address" value="{{ request('drop') }}">
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <label class="form-label small fw-bold text-uppercase mb-1">Date</label>
                    <input type="date" name="date" class="form-control border-dark py-2" value="{{ request('date') }}">
                </div>

                <div class="col-12 col-sm-6 col-md-2">
                    <button class="btn btn-dark w-100 fw-bold py-2 shadow-sm"
                        style="background-color: #FF9F43; border: 2px solid #000; color: #000; height: 45px;">
                        SEARCH
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if($rides->count() > 0)
        <div class="row g-3 g-md-4">
            @foreach($rides as $ride)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-2 border-dark rounded-4 h-100 shadow-sm bg-white overflow-hidden">
                        <div class="card-header bg-dark text-white p-3 border-0">
                            <div class="d-flex justify-content-between align-items-center overflow-hidden">
                                <span class="fw-bold text-truncate small">{{ $ride->pickup_address }}</span>
                                <span class="mx-2">→</span>
                                <span class="fw-bold text-truncate small">{{ $ride->drop_address }}</span>
                            </div>
                        </div>

                        <div class="card-body p-3 p-md-4 d-flex flex-column">
                            <div class="d-flex justify-content-between mb-4 flex-wrap gap-2">
                                <div>
                                    <p class="text-muted small mb-0 fw-bold" style="font-size: 10px;">DATE & TIME</p>
                                    <p class="fw-bold mb-0 small">{{ \Carbon\Carbon::parse($ride->date)->format('M d') }} | {{ $ride->time }}</p>
                                </div>
                                <div class="text-md-end">
                                    <p class="text-muted small mb-0 fw-bold" style="font-size: 10px;">PRICE</p>
                                    <p class="h4 fw-black mb-0 text-success">₹{{ $ride->price }}</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-center p-2 p-md-3 rounded-3 mb-4 mt-auto"
                                style="background: #f8f9fa; border: 1px solid #ddd;">
                                <div class="flex-grow-1 overflow-hidden">
                                    <small class="text-muted d-block fw-bold text-uppercase" style="font-size: 9px;">Driver</small>
                                    <span class="fw-bold text-dark text-truncate d-block small">{{ $ride->user->name }}</span>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-dark rounded-pill" style="font-size: 10px;">{{ $ride->available_seats }} Left</span>
                                </div>
                            </div>

                            <a href="{{ route('rides.detailShow', $ride->id) }}"
                                class="btn w-100 fw-black py-2 rounded-3 text-uppercase shadow-sm"
                                style="background-color: #FF9F43; border: 2px solid #000; color: #000;">
                                View & Book
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5 border-2 border-dark border-dashed rounded-5 mt-4 bg-white mx-1">
            <h5 class="text-muted fw-bold">No rides found for your search.</h5>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-dark mt-3 fw-bold border-2">Reset Filters</a>
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