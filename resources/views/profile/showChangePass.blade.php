@extends('layouts.dashboard')

@section('content')
    <style>
        .password-card {
            border: 2px solid #000000;
            border-radius: 24px;
            box-shadow: 8px 8px 0px 0px rgba(0, 0, 0, 1);
            background: #ffffff;
            max-width: 500px;
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
            padding: 14px;
            text-transform: uppercase;
            transition: 0.2s;
        }

        .btn-save:hover {
            background-color: #ff8e1d;
            box-shadow: 4px 4px 0px 0px #000;
            transform: translate(-2px, -2px);
        }

        .error-text {
            color: #dc3545;
            font-size: 0.75rem;
            font-weight: 700;
            margin-top: 4px;
        }
    </style>

    <div class="container py-4">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('profile') }}" class="btn btn-outline-dark rounded-circle me-3"
                style="width: 40px; height: 40px;">←</a>
            <h3 class="fw-black m-0">Security</h3>
        </div>

        <div class="card password-card p-4 p-md-5 mx-auto">
            <h4 class="fw-black mb-4">Change Password</h4>

            <form action="{{ route('savePassword') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Current Password</label>
                    <input type="password" name="current_password"
                        class="form-control @error('current_password') is-invalid @enderror" placeholder="••••••••">
                    @error('current_password')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                    @if(session('incorrect'))
                        <div class="error-text">{{ session('incorrect') }}</div>
                    @endif
                </div>

                <hr class="my-4 border-dark opacity-10">

                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" name="new_password"
                        class="form-control @error('new_password') is-invalid @enderror" placeholder="New password">
                    @error('new_password')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" name="confirm_password"
                        class="form-control @error('confirm_password') is-invalid @enderror"
                        placeholder="Repeat new password">
                    @error('confirm_password')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                    @if(session('errorpass'))
                        <div class="error-text">{{ session('errorpass') }}</div>
                    @endif
                </div>

                <button type="submit" class="btn btn-save w-100">Update Password</button>
            </form>
        </div>
    </div>
@endsection