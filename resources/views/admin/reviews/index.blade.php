@extends('admin.layout.app')

@section('content')
    <style>
        .admin-card {
            border: 3px solid #000;
            border-radius: 20px;
            background: #fff;
            transition: 0.2s;
        }

        .admin-card:hover {
            box-shadow: 8px 8px 0px 0px #000;
            transform: translate(-3px, -3px);
        }

        .user-pill {
            background: #f8f9fa;
            border: 1px solid #000;
            padding: 5px 12px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.85rem;
            display: inline-block;
        }

        .rating-badge {
            background: #FF9F43;
            color: #000;
            border: 2px solid #000;
            font-weight: 900;
            padding: 2px 8px;
            border-radius: 8px;
        }

        .search-input {
            border: 3px solid #000;
            border-radius: 12px;
            padding: 12px 20px;
            font-weight: 700;
        }

        .search-input:focus {
            border-color: #FF9F43;
            box-shadow: none;
        }

        .btn-admin-search {
            background: #000;
            color: #fff;
            border: 3px solid #000;
            font-weight: 900;
            border-radius: 12px;
            padding: 0 25px;
            transition: 0.2s;
        }

        .btn-admin-search:hover {
            background: #FF9F43;
            color: #000;
        }

        .review-text {
            background: #fff8f2;
            border-left: 4px solid #FF9F43;
            padding: 10px;
            font-style: italic;
            font-size: 0.9rem;
            border-radius: 0 8px 8px 0;
        }
    </style>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h2 class="fw-black m-0 text-uppercase">⭐ Rating Management</h2>
                <p class="text-muted fw-bold mb-0">Monitor and moderate community feedback</p>
            </div>
            <div class="badge bg-dark p-2 px-3 rounded-pill">
                Total Reviews: {{ $ratings->total() }}
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-lg-6">
                <form method="GET" class="d-flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control search-input"
                        placeholder="Search by Giver or Receiver name...">
                    <button class="btn btn-admin-search">SEARCH</button>
                </form>
            </div>
        </div>

        <div class="row g-4">
            @forelse($ratings as $rating)
                <div class="col-md-6 col-xl-4">
                    <div class="admin-card p-4 h-100 d-flex flex-column">

                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="rating-badge">★ {{ $rating->rating }}</span>
                            <small class="text-muted fw-bold">{{ $rating->created_at->format('d M, Y') }}</small>
                        </div>

                        <div class="mb-3">
                            <div class="mb-2">
                                <small class="text-muted fw-black text-uppercase d-block"
                                    style="font-size: 10px;">Reviewer</small>
                                <span class="user-pill">{{ $rating->giver->name }}</span>
                            </div>
                            <div class="text-center my-1" style="font-size: 12px;">⬇️</div>
                            <div>
                                <small class="text-muted fw-black text-uppercase d-block"
                                    style="font-size: 10px;">Recipient</small>
                                <span class="user-pill" style="border-color: #FF9F43;">{{ $rating->givenTo->name }}</span>
                            </div>
                        </div>

                        <div class="review-text mb-4 flex-grow-1">
                            "{{ $rating->review }}"
                        </div>

                        <form action="{{ route('admin.reviews.delete', $rating->id) }}" method="POST"
                            onsubmit="return confirm('ADMIN ACTION: Are you sure you want to delete this feedback permanently?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger w-100 fw-black rounded-3 py-2 border-2 text-uppercase"
                                style="font-size: 0.8rem;">
                                Delete This Review
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="display-1">📭</div>
                    <h4 class="fw-black">No reviews found matching your search.</h4>
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-dark mt-3 rounded-pill px-4">Clear Filters</a>
                </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $ratings->appends(request()->query())->links() }}
        </div>
    </div>

@endsection