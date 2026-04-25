@extends('layouts.dashboard')

@section('title', 'Edit Ride')

@section('content')
<style>
    .edit-ride-card {
        border: 2px solid #000000;
        border-radius: 20px;
        box-shadow: 6px 6px 0px 0px rgba(0,0,0,1);
        background: #ffffff;
    }
    .form-label {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
    .form-control {
        border: 1px solid #000000;
        border-radius: 10px;
        padding: 12px;
    }
    .form-control:focus {
        border-color: #FF9F43;
        box-shadow: none;
    }
    .btn-update {
        background-color: #FF9F43;
        color: #000;
        border: 2px solid #000;
        font-weight: 900;
        border-radius: 12px;
        padding: 12px;
        text-transform: uppercase;
        transition: 0.2s;
    }
    .btn-update:hover {
        background-color: #ff8e1d;
        box-shadow: 4px 4px 0px 0px #000;
        transform: translate(-2px, -2px);
    }
    .route-display {
        background-color: #f8f9fa;
        border-left: 4px solid #FF9F43;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 30px;
    }
</style>

<div class="container py-3">
    <div class="card edit-ride-card p-4 p-md-5 mx-auto" style="max-width: 700px;">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('rides.my') }}" class="btn btn-outline-dark rounded-circle me-3" style="width: 40px; height: 40px; border-width: 2px;">←</a>
            <h3 class="fw-black m-0">Edit Ride Details</h3>
        </div>

        <div class="route-display">
            <small class="text-muted fw-bold d-block text-uppercase" style="font-size: 10px;">Current Route</small>
            <span class="fw-bold">{{ $ride->pickup_address }}</span> 
            <span class="mx-2 text-muted">→</span> 
            <span class="fw-bold">{{ $ride->drop_address }}</span>
        </div>

        <form method="POST" action="{{ route('ride.update', $ride->id) }}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">Date of Journey</label>
                    <input type="date" name="date" class="form-control" value="{{ $ride->date }}" required>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Departure Time</label>
                    <input type="time" name="time" class="form-control" value="{{ $ride->time }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">Price per Seat (₹)</label>
                    <input type="number" name="price" class="form-control" value="{{ $ride->price }}" required>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Total Seats Capacity</label>
                    <input type="number" name="total_seats" class="form-control" value="{{ $ride->total_seats }}" required>
                    @error('total_seats')
                        <p class="text-danger font-normal mb-0">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-4 pt-2">
                <button type="submit" class="btn btn-update w-100">Update Ride Information</button>
            </div>
            
            <div class="text-center mt-3">
                <a href="{{ route('rides.my') }}" class="text-dark small fw-bold text-decoration-none opacity-50">Cancel and Go Back</a>
            </div>
        </form>
    </div>
</div>
@endsection