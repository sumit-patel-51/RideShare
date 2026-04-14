@extends('layouts.dashboard')

@section('content')
    <style>
        .danger-container {
            border: 2px solid #000;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 10px 10px 0px 0px #dc3545;
            background: #fff;
        }

        /* Left Side: Warning Zone */
        .warning-zone {
            background-color: #dc3545;
            color: #fff;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .warning-zone h2 {
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: -1px;
        }

        /* Right Side: Action Zone */
        .action-zone {
            padding: 40px;
            background: #fff;
        }

        .form-label {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            color: #000;
        }

        .form-control {
            border: 2px solid #000;
            border-radius: 12px;
            padding: 12px;
        }

        .form-control:focus {
            border-color: #dc3545;
            box-shadow: none;
        }

        .btn-delete-final {
            background: #000;
            color: #fff;
            border: none;
            font-weight: 900;
            text-transform: uppercase;
            padding: 15px;
            border-radius: 12px;
            transition: 0.2s;
        }

        .btn-delete-final:hover {
            background: #dc3545;
            transform: scale(1.02);
        }
    </style>

    <div class="container py-3">
        <div class="danger-container">
            <div class="row g-0">

                <div class="col-lg-5 warning-zone">
                    <div class="mb-4 display-3">⚠️</div>
                    <h2>Stop & Think.</h2>
                    <p class="lead opacity-75 mb-4">Deleting your account is permanent and cannot be reversed.</p>

                    <div class="mt-2">
                        <div class="d-flex mb-3">
                            <div class="me-3">🚫</div>
                            <div><strong>Active Rides:</strong> All your scheduled trips will be cancelled immediately.
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="me-3">📉</div>
                            <div><strong>Reputation:</strong> Your ratings and reviews will be deleted forever.</div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="me-3">📂</div>
                            <div><strong>History:</strong> You will lose access to all past booking receipts.</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 action-zone">
                    <h4 class="fw-black mb-4">Confirm Identity</h4>

                    <form action="{{ route('deleteUser') }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="mb-4">
                            <label class="form-label">Verify Email Address</label>
                            <input type="email" name="email_confirmation" class="form-control"
                                placeholder="{{ auth()->user()->email }}" required>
                            @error('email_confirmation')
                                <div class="text-danger small fw-bold mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Account Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                            @error('password')
                                <div class="text-danger small fw-bold mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Reason for leaving (Optional)</label>
                            <textarea name="reason" class="form-control" rows="2"
                                placeholder="Tell us how we could have done better..."></textarea>
                        </div>

                        <div class="row g-3 align-items-center mt-2">
                            <div class="col-sm-6">
                                <a href="{{ route('profile') }}" class="btn btn-outline-dark w-100 fw-bold py-3 rounded-3">
                                    No, Take Me Back
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-delete-final w-100 shadow-sm"
                                    onclick="return confirm('Final confirmation: Delete account?')">
                                    Delete Permanently
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection