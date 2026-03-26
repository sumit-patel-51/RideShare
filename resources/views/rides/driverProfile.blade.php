@extends('layouts.dashboard')

@section('content')
    <div class="container py-4">
        <div class="card border-2 border-dark rounded-4 shadow-sm mb-4 bg-white">
            <div class="card-body p-4 p-md-5">
                <div class="d-flex align-items-center flex-wrap">

                    @if ($user->image)
                        <img src="{{ asset('userImages/' . $user->image) }}"
                            class="rounded-circle border border-3 border-dark mb-3"
                            style="width: 100px; height: 100px; object-fit: cover;">
                    @else
                        <div class="rounded-circle border border-3 border-dark d-flex align-items-center justify-content-center bg-light shadow-sm mb-3 mb-md-0"
                            style="width: 100px; height: 100px; background-color: #FF9F43 !important;">
                            <span class="fw-black display-4">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                    @endif

                    <div class="ms-md-4 flex-grow-1">
                        <h2 class="fw-black mb-1">{{ $user->name }}</h2>
                        <p class="text-muted fw-bold mb-2">Member since {{ $user->created_at->format('M Y') }}</p>
                        <div class="d-flex gap-3">
                            <span class="badge border border-dark text-dark px-3 py-2 rounded-pill"
                                style="background-color: #FF9F43;">
                                ✉️ {{ $user->email }}
                            </span>
                        </div>
                    </div>

                    <div class="text-md-end mt-3 mt-md-0">
                        <div class="h1 fw-black mb-0">⭐ {{ round($avgRating, 1) ?? '0.0' }}</div>
                        <p class="text-muted fw-bold small text-uppercase mb-0">From {{ $totalRatings }} Reviews</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h4 class="fw-black mb-4">📝 Recent Reviews</h4>

                @forelse ($rev as $revs)
                    <div class="card border-2 border-dark rounded-4 mb-3 shadow-sm bg-white overflow-hidden">
                        <div class="card-body p-4">

                            <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">

                                <div class="d-flex align-items-center gap-3">
                                    @if ($revs->giver->image)
                                        <img src="{{ asset('userImages/' . $revs->giver->image) }}"
                                            class="rounded-circle border border-3 border-dark mb-3"
                                            style="width:50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle border border-dark d-flex align-items-center justify-content-center bg-light shadow-sm"
                                            style="width: 45px; height: 45px; background-color: #FF9F43 !important;">
                                            <span class="fw-black h6 mb-0">{{ substr($revs->giver->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="fw-black mb-0 text-dark">{{ $revs->giver->name }}</p>
                                        <div class="text-warning small mb-0">
                                            @for($i = 1; $i <= 5; $i++)
                                                {{ $i <= $revs->rating ? '★' : '☆' }}
                                            @endfor
                                        </div>
                                    </div>
                                </div>

                                <small class="text-muted fw-bold">{{ $revs->created_at->diffForHumans() }}</small>
                            </div>

                            <div class="ps-md-5 ms-md-2">
                                <p class="mb-0 fw-medium text-dark-emphasis p-3 bg-light rounded-3" style="font-style: italic;">
                                    "{{ $revs->review }}"
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 border border-dark border-dashed rounded-5 bg-white">
                        <p class="text-muted fw-bold mb-0">No reviews yet for this user.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection