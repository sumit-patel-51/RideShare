@extends('layouts.dashboard')

@section('content')
<style>
    .post-ride-card {
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
        color: #000;
    }
    .form-control {
        border: 1px solid #000000;
        border-radius: 10px;
        padding: 10px;
    }
    .form-control:focus {
        border-color: #FF9F43;
        box-shadow: none;
    }
    .section-title {
        font-weight: 900;
        font-size: 1rem;
        border-bottom: 2px solid #FF9F43;
        display: inline-block;
        margin-bottom: 20px;
        padding-bottom: 3px;
    }
    .btn-post {
        background-color: #FF9F43;
        color: #000;
        border: 2px solid #000;
        font-weight: 900;
        border-radius: 12px;
        padding: 12px;
        text-transform: uppercase;
        transition: 0.2s;
    }
    .btn-post:hover {
        background-color: #ff8e1d;
        box-shadow: 4px 4px 0px 0px #000;
        transform: translate(-2px, -2px);
    }
</style>

<div class="container py-4">
    <div class="card post-ride-card p-4 p-md-5">
        <h3 class="fw-black mb-5">Create a New Ride</h3>

        <form method="POST" action="{{ route('rides.store') }}">
            @csrf

            <div class="section-title">ROUTE DETAILS</div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Pickup Address</label>
                    <input type="text" name="pickup_address" class="form-control" placeholder="City, Area or Street" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Drop Address</label>
                    <input type="text" name="drop_address" class="form-control" placeholder="Destination City" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Time</label>
                    <input type="time" name="time" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Price ($)</label>
                    <input type="number" name="price" class="form-control" placeholder="0.00" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Available Seats</label>
                    <input type="number" name="total_seats" class="form-control" placeholder="1-4" required>
                </div>
            </div>

            <div class="section-title mt-4">VEHICLE DETAILS</div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Vehicle Number</label>
                    <input type="text" name="vehicle_number" class="form-control" placeholder="AB51 52 1234" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">License Number</label>
                    <input type="text" name="license_number" class="form-control" placeholder="Full License ID" required>
                </div>
            </div>

            <div class="mt-5">
                <button type="submit" class="btn btn-post w-100">Publish Ride</button>
            </div>
        </form>
    </div>
</div>
@endsection