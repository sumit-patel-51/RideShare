@extends('admin.layout.app')
@section('title', 'User Management')

@section('content')
    <style>
        /* --- Table Design --- */
        .admin-table-container {
            border: 3px solid #000;
            border-radius: 20px;
            overflow: hidden;
            /* Clips table corners to match radius */
            background: #fff;
            box-shadow: 8px 8px 0px 0px #000;
        }

        .table {
            margin-bottom: 0;
            vertical-align: middle;
        }

        .table thead {
            background-color: #000;
            color: #fff;
        }

        .table thead th {
            border: none;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            padding: 15px;
        }

        .table tbody tr {
            transition: 0.2s;
        }

        .table tbody tr:hover {
            background-color: #fff8f2;
            /* Light orange tint on hover */
        }

        .table td {
            padding: 15px;
            border-color: #eee;
            font-weight: 600;
            color: #333;
        }

        /* --- Status Badges --- */
        .status-pill {
            border: 2px solid #000;
            font-weight: 800;
            text-transform: uppercase;
            font-size: 0.65rem;
            padding: 5px 10px;
            border-radius: 6px;
        }

        /* --- Form Controls --- */
        .form-control,
        .form-select {
            border: 2px solid #000;
            border-radius: 12px;
            font-weight: 700;
            height: 45px;
        }

        .form-control:focus {
            border-color: #FF9F43;
            box-shadow: none;
        }
    </style>

    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-black m-0">👤 USER MANAGEMENT</h2>
                <p class="text-muted fw-bold">Manage system access and monitor user reputation.</p>
            </div>
        </div>

        <div class="p-4 mb-4" style="border: 3px solid #000; border-radius: 20px; background: #f8f9fa;">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="small fw-black text-uppercase mb-1">Search User</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="Name or email...">
                </div>
                <div class="col-md-2">
                    <label class="small fw-black text-uppercase mb-1">Role</label>
                    <select name="role" class="form-select">
                        <option value="">All Roles</option>
                        <option value="1" {{ request('role') == 1 ? 'selected' : '' }}>User</option>
                        <option value="2" {{ request('role') == 2 ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="small fw-black text-uppercase mb-1">Status</label>
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="small fw-black text-uppercase mb-1">Sort By</label>
                    <select name="sort" class="form-select">
                        <option value="">Recently Joined</option>
                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-dark w-100 fw-black rounded-3 shadow-sm" style="height:45px;">APPLY</button>
                </div>
            </form>
        </div>

        <div class="admin-table-container shadow-sm">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>User Info</th>
                            <th>Role</th>
                            <th class="text-center">Rating</th>
                            <th class="text-center">Rides</th>
                            <th class="text-center">Bookings</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            @php
                                $avg_rating = App\Models\Rating::where('given_to', $user->id)->avg('rating');
                                $rides_count = App\Models\Ride::where('user_id', $user->id)->count();
                                $bookings_count = App\Models\Booking::where('user_id', $user->id)->count();
                            @endphp
                            <tr>
                                <td>
                                    <div class="fw-black text-dark">{{ $user->name }}</div>
                                    <div class="text-muted small">{{ $user->email }}</div>
                                </td>
                                <td>
                                    <span class="fw-bold {{ $user->role == 2 ? 'text-primary' : 'text-dark' }}">
                                        {{ $user->role == 2 ? 'ADMIN' : 'USER' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="fw-black text-warning">⭐ {{ round($avg_rating, 1) ?: '0.0' }}</span>
                                </td>
                                <td class="text-center">
                                    <span
                                        class="badge bg-light text-dark border border-dark rounded-pill">{{ $rides_count }}</span>
                                </td>
                                <td class="text-center">
                                    <span
                                        class="badge bg-light text-dark border border-dark rounded-pill">{{ $bookings_count }}</span>
                                </td>
                                <td>
                                    <span
                                        class="status-pill {{ $user->status == 'active' ? 'bg-success text-white' : 'bg-danger text-white' }}">
                                        {{ $user->status }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.userProfile', $user->id) }}"
                                            class="btn btn-sm btn-outline-dark fw-black rounded-pill px-3">
                                            VIEW
                                        </a>
                                        <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST">
                                            @csrf
                                            <button
                                                class="btn btn-sm {{ $user->status == 'active' ? 'btn-dark' : 'btn-warning' }} fw-black rounded-pill px-3 shadow-sm">
                                                {{ $user->status == 'active' ? 'BAN' : 'ACTIVATE' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-center custom-admin-pagination">
            {{ $users->appends(request()->query())->links() }}
        </div>
    </div>
@endsection