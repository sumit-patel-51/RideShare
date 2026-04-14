@extends('layouts.dashboard')

@section('title', "My Profile")

@section('content')
    <div class="container py-3">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <h3 class="fw-black m-0">My Profile</h3>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('showEdit') }}" class="btn btn-dark fw-bold px-3 px-md-4 rounded-pill shadow-sm flex-grow-1 flex-md-grow-0"
                    style="background-color: #FF9F43; border: 2px solid #000; color: black; font-size: 0.85rem;">
                    Edit Profile
                </a>
                <a href="{{ route('showChangePass') }}" class="btn btn-dark fw-bold px-3 px-md-4 rounded-pill shadow-sm flex-grow-1 flex-md-grow-0"
                    style="background-color: #FF9F43; border: 2px solid #000; color: black; font-size: 0.85rem;">
                    Password
                </a>
                <a href="{{ route('deleteUser') }}" class="btn btn-danger fw-bold px-3 px-md-4 rounded-pill shadow-sm flex-grow-1 flex-md-grow-0"
                    style="border: 2px solid #000; color: white; font-size: 0.85rem;">
                    Delete
                </a>
            </div>
        </div>

        <div class="card border-2 border-dark rounded-4 shadow-sm bg-white overflow-hidden mb-5">
            <div class="card-body p-3 p-md-5">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center mb-4 mb-md-0">
                        @if($user->image)
                            <img src="{{ asset('userImages/' . $user->image) }}" alt="Profile"
                                class="rounded-circle border border-3 border-dark shadow-sm img-fluid"
                                style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="rounded-circle border border-3 border-dark d-flex align-items-center justify-content-center bg-light shadow-sm mx-auto"
                                style="width: 120px; height: 120px; @media(min-width: 768px){ width: 150px; height: 150px; } background-color: #FF9F43 !important;">
                                <span class="fw-black display-1">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-9">
                        <div class="row g-3 g-md-4 text-center text-md-start">
                            <div class="col-sm-6">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Full Name</label>
                                <p class="h5 fw-black text-dark mb-0 text-truncate">{{ $user->name }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Email Address</label>
                                <p class="h6 fw-bold text-dark mb-0 text-truncate">{{ $user->email }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Phone Number</label>
                                <p class="h6 fw-bold text-dark mb-0">{{ $user->phone ?? 'Not provided' }}</p>
                            </div>

                            <div class="col-12 my-2 d-none d-md-block">
                                <hr class="border-dark opacity-10">
                            </div>

                            <div class="col-sm-6">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">License No</label>
                                <p class="h6 fw-bold text-dark mb-0">{{ $user->license_no ?: 'Not provided' }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Vehicle No</label>
                                <p class="h6 fw-bold text-dark mb-0">{{ $user->vehicle_no ?: 'Not provided' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 mb-4">
                <h4 class="fw-black mb-3">Reputation</h4>
                <div class="row g-2 g-md-3">
                    <div class="col-6 col-lg-12">
                        <div class="p-3 p-md-4 border border-dark rounded-4 bg-white shadow-sm text-center">
                            <span class="text-muted small fw-bold text-uppercase d-block" style="font-size: 0.65rem;">Avg Rating</span>
                            <h3 class="fw-black mb-0 text-dark">⭐{{ round($avgRating, 1) }}</h3>
                        </div>
                    </div>
                    <div class="col-6 col-lg-12">
                        <div class="p-3 p-md-4 border border-dark rounded-4 bg-white shadow-sm text-center">
                            <span class="text-muted small fw-bold text-uppercase d-block" style="font-size: 0.65rem;">Total Reviews</span>
                            <h3 class="fw-black mb-0 text-dark">{{ $totalRating }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 mb-4">
                <h4 class="fw-black mb-3">Recent Reviews</h4>
                @forelse ($rating as $r)
                    <div class="card border-2 border-dark rounded-4 mb-3 shadow-sm bg-white overflow-hidden">
                        <div class="card-body p-3 p-md-4">
                            <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                                <div class="d-flex align-items-center gap-2 gap-md-3">
                                    @if ($r->giver->image)
                                        <img src="{{ asset('userImages/' . $r->giver->image) }}"
                                            class="rounded-circle border-2 border-dark"
                                            style="width: 35px; height: 35px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle border border-dark d-flex align-items-center justify-content-center bg-light"
                                            style="width: 35px; height: 35px; background-color: #FF9F43 !important;">
                                            <span class="fw-bold extra-small" style="font-size: 0.7rem;">{{ substr($r->giver->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="fw-black mb-0 small">{{ $r->giver->name }}</p>
                                        <div class="text-warning extra-small" style="font-size: 0.7rem;">
                                            @for($i = 1; $i <= 5; $i++)
                                                {{ $i <= $r->rating ? '★' : '☆' }}
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted fw-bold" style="font-size: 0.65rem;">{{ $r->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-0 fw-medium text-dark-emphasis p-2 p-md-3 bg-light rounded-3 small" style="font-style: italic;">
                                "{{ $r->review }}"
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 border border-dark border-dashed rounded-5 bg-white">
                        <p class="text-muted fw-bold mb-0">No reviews found yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection