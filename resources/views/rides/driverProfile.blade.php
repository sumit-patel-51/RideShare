@extends('layouts.dashboard')

@section('content')
    <div class="container py-2 py-md-4">
        <div class="card border-2 border-dark rounded-4 shadow-sm mb-4 bg-white overflow-hidden">
            <div class="card-body p-3 p-md-5">
                <div class="row align-items-center g-3">
                    
                    <div class="col-12 col-md-auto text-center text-md-start">
                        @if ($user->image)
                            <img src="{{ asset('userImages/' . $user->image) }}"
                                class="rounded-circle border border-3 border-dark shadow-sm"
                                style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                            <div class="rounded-circle border border-3 border-dark d-flex align-items-center justify-content-center bg-light shadow-sm mx-auto"
                                style="width: 100px; height: 100px; background-color: #FF9F43 !important;">
                                <span class="fw-black display-4 text-dark">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="col-12 col-md text-center text-md-start">
                        <h2 class="fw-black mb-1 text-dark">{{ $user->name }}</h2>
                        <p class="text-muted fw-bold mb-2 small">Member since {{ $user->created_at->format('M Y') }}</p>
                        <div class="d-flex justify-content-center justify-content-md-start">
                            <span class="badge border border-dark text-dark px-3 py-2 rounded-pill shadow-sm"
                                style="background-color: #FF9F43; font-size: 0.8rem;">
                                ✉️ {{ $user->email }}
                            </span>
                        </div>
                    </div>

                    <div class="col-12 col-md-auto text-center text-md-end mt-2 mt-md-0 pt-3 pt-md-0 border-top border-dark border-opacity-10 border-md-0">
                        <div class="h1 fw-black mb-0 text-dark">⭐ {{ round($avgRating, 1) ?? '0.0' }}</div>
                        <p class="text-muted fw-bold small text-uppercase mb-0" style="letter-spacing: 0.5px;">
                            From {{ $totalRatings }} Reviews
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h4 class="fw-black mb-4 px-1">📝 Recent Reviews</h4>

                @forelse ($rev as $revs)
                    <div class="card border-2 border-dark rounded-4 mb-3 shadow-sm bg-white overflow-hidden">
                        <div class="card-body p-3 p-md-4">

                            <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                                <div class="d-flex align-items-center gap-2 gap-md-3">
                                    @if ($revs->giver->image)
                                        <img src="{{ asset('userImages/' . $revs->giver->image) }}"
                                            class="rounded-circle border-2 border-dark"
                                            style="width: 45px; height: 45px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle border-2 border-dark d-flex align-items-center justify-content-center bg-light"
                                            style="width: 40px; height: 40px; background-color: #FF9F43 !important;">
                                            <span class="fw-black h6 mb-0">{{ substr($revs->giver->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    
                                    <div>
                                        <p class="fw-black mb-0 text-dark small">{{ $revs->giver->name }}</p>
                                        <div class="text-warning extra-small" style="font-size: 0.75rem;">
                                            @for($i = 1; $i <= 5; $i++)
                                                {{ $i <= $revs->rating ? '★' : '☆' }}
                                            @endfor
                                        </div>
                                    </div>
                                </div>

                                <small class="text-muted fw-bold" style="font-size: 0.7rem;">{{ $revs->created_at->diffForHumans() }}</small>
                            </div>

                            <div class="ps-md-5 ms-md-2">
                                <div class="p-3 bg-light rounded-3 border-start border-3 border-warning shadow-sm">
                                    <p class="mb-0 fw-medium text-dark-emphasis small" style="font-style: italic; line-height: 1.5;">
                                        "{{ $revs->review }}"
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 border-2 border-dark border-dashed rounded-5 bg-white mx-1">
                        <p class="text-muted fw-bold mb-0">No reviews yet for this user.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection