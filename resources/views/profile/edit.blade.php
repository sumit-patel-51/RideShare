@extends('layouts.dashboard')

@section('content')
    <style>
        .edit-profile-card {
            border: 2px solid #000000;
            border-radius: 24px;
            box-shadow: 8px 8px 0px 0px rgba(0, 0, 0, 1);
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
            border-radius: 12px;
            padding: 12px;
        }

        .form-control:focus {
            border-color: #FF9F43;
            box-shadow: none;
        }

        .btn-save {
            background-color: #FF9F43;
            color: #000;
            border: 2px solid #000;
            font-weight: 900;
            border-radius: 12px;
            padding: 15px;
            text-transform: uppercase;
            transition: 0.2s;
        }

        .btn-save:hover {
            background-color: #ff8e1d;
            box-shadow: 4px 4px 0px 0px #000;
            transform: translate(-2px, -2px);
        }
    </style>

    <div class="container py-4">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('profile') }}" class="btn btn-outline-dark rounded-circle me-3"
                style="width: 40px; height: 40px;">←</a>
            <h3 class="fw-black m-0">Edit Profile</h3>
        </div>

        <div class="card edit-profile-card p-4 p-md-5 mx-auto" style="max-width: 800px;">
            <form action="{{ route('updateProfile', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="text-center mb-5">
                    <div class="position-relative d-inline-block">
                        @if($user->image)
                            <img src="{{ asset('userImages/' . $user->image) }}"
                                class="rounded-circle border border-3 border-dark mb-3"
                                style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                            <div class="rounded-circle border border-3 border-dark d-flex align-items-center justify-content-center bg-light mb-3 mx-auto"
                                style="width: 120px; height: 120px; background-color: #FF9F43 !important;">
                                <span class="fw-black display-4">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label class="form-label d-block">Change Profile Photo</label>
                            <input type="file" name="image" class="form-control form-control-sm border-dark">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>
                    <div class="col-md-12 mb-4">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}"
                            placeholder="+91 XXXX XXX XXX">
                    </div>
                </div>

                <div class="border-top border-dark opacity-10 my-4"></div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">License Number</label>
                        <input type="text" name="license_no" class="form-control" value="{{ $user->license_no }}"
                            placeholder="Enter License ID">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Vehicle Registration No.</label>
                        <input type="text" name="vehicle_no" class="form-control" value="{{ $user->vehicle_no }}"
                            placeholder="Enter Plate Number">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-save w-100">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection