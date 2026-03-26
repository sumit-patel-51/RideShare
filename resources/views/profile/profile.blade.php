@extends('layouts.dashboard')

@section('title', "My Profile")

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-black m-0">My Profile</h3>
            <a href="{{ route('showEdit') }}" class="btn btn-dark fw-bold px-4 rounded-pill shadow-sm"
                style="background-color: #FF9F43; border: 2px solid #000; color: black;">
                Edit Profile
            </a>
        </div>

        <div class="card border-2 border-dark rounded-4 shadow-sm bg-white overflow-hidden mb-5">
            <div class="card-body p-4 p-md-5">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center mb-4 mb-md-0">
                        @if($user->image)
                            <img src="{{ asset('userImages/' . $user->image) }}" alt="Profile"
                                class="rounded-circle border border-3 border-dark shadow-sm"
                                style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="rounded-circle border border-3 border-dark d-flex align-items-center justify-content-center bg-light shadow-sm mx-auto"
                                style="width: 150px; height: 150px; background-color: #FF9F43 !important;">
                                <span class="fw-black display-1">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-9">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Full Name</label>
                                <p class="h5 fw-black text-dark mb-0">{{ $user->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Email Address</label>
                                <p class="h5 fw-bold text-dark mb-0">{{ $user->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Phone Number</label>
                                <p class="h5 fw-bold text-dark mb-0">{{ $user->phone ?? 'Not provided' }}</p>
                            </div>

                            <div class="col-12 my-2">
                                <hr class="border-dark opacity-10">
                            </div>

                            <div class="col-md-6">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">License Number</label>
                                <p class="h5 fw-bold text-dark mb-0">
                                    {{ $user->license_no ? $user->license_no : 'Not provided' }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Vehicle Number</label>
                                <p class="h5 fw-bold text-dark mb-0">
                                    {{ $user->vehicle_no ? $user->vehicle_no : 'Not provided' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 mb-4">
                <h4 class="fw-black mb-4">Reputation</h4>
                <div class="row g-3">
                    <div class="col-6 col-lg-12">
                        <div class="p-4 border border-dark rounded-4 bg-white shadow-sm text-center">
                            <span class="text-muted small fw-bold text-uppercase d-block">Avg Rating</span>
                            <h2 class="fw-black mb-0 text-dark">⭐ {{ round($avgRating, 1) }}</h2>
                        </div>
                    </div>
                    <div class="col-6 col-lg-12">
                        <div class="p-4 border border-dark rounded-4 bg-white shadow-sm text-center">
                            <span class="text-muted small fw-bold text-uppercase d-block">Total Reviews</span>
                            <h2 class="fw-black mb-0 text-dark">{{ $totalRating }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 mb-4">
                <h4 class="fw-black mb-4">Recent Reviews</h4>
                @forelse ($rating as $r)
                    <div class="card border-2 border-dark rounded-4 mb-3 shadow-sm bg-white overflow-hidden">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    @if ($r->giver->image)
                                        <img src="{{ asset('userImages/' . $r->giver->image) }}"
                                            class="rounded-circle border border-3 border-dark mb-3"
                                            style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle border border-dark d-flex align-items-center justify-content-center bg-light"
                                            style="width: 40px; height: 40px; background-color: #FF9F43 !important;">
                                            <span class="fw-bold small">{{ substr($r->giver->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="fw-black mb-0">{{ $r->giver->name }}</p>
                                        <div class="text-warning small">
                                            @for($i = 1; $i <= 5; $i++)
                                                {{ $i <= $r->rating ? '★' : '☆' }}
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted fw-bold">{{ $r->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-0 fw-medium text-dark-emphasis p-3 bg-light rounded-3" style="font-style: italic;">
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