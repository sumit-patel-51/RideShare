<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Rating;
use App\Models\Ride;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //admin dashboard
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalRides = Ride::count();
        $totalBookings = Booking::count();
        $avgRating = Rating::avg('rating');

        // monthly rides
        $ridesData = Ride::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month');

        // monthly bookings
        $bookingsData = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month');

        // format data for 12 months
        $months = [];
        $rides = [];
        $bookings = [];

        for ($i = 1; $i <= 12; $i++) {
            $months[] = Carbon::create()->month($i)->format('M');
            $rides[] = $ridesData[$i] ?? 0;
            $bookings[] = $bookingsData[$i] ?? 0;
        }

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalRides',
            'totalBookings',
            'avgRating',
            'months',
            'rides',
            'bookings'
        ));
    }

    //users
    public function index(Request $request)
    {
        $query = User::query()
            ->withCount('rides', 'bookings')->withAvg('givenTo', 'rating');

        //Search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        //Filter Role
        if ($request->role) {
            $query->where('role', $request->role);
        }

        //Filter Status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        //Sort Rating
        if ($request->sort == 'rating') {
            $query->orderBy('given_to_avg_rating', 'desc');
        } else {
            $query->latest();
        }

        $users = $query->paginate(7)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    //active, inactice
    public function toggleStatus(User $user)
    {
        // prevent admin blocking himself
        if ($user->id == auth()->id()) {
            return back()->with('error', 'You cannot deactivate yourself.');
        }

        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();

        return back()->with('success', 'User status updated.');
    }

    //rides
    public function rides(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $rides = Ride::with(['user', 'bookings'])
            ->when($search, function ($query) use ($search) {
                $query->where('pickup_address', 'like', "%$search%")
                    ->orWhere('drop_address', 'like', "%$search%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    });
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(6);

        return view('admin.rides.index', compact('rides'));
    }

    //showRideDetail
    public function show(Ride $ride)
    {
        return view('admin.rides.show', compact('ride'));
    }

    //ride cancel
    public function cancel(Ride $ride)
    {
        if ($ride->status === 'Cancelled') {
            return back()->with('error', 'Ride already cancelled.');
        }

        if ($ride->status === 'Completed') {
            return back()->with('error', 'Completed ride cannot be cancelled.');
        }

        $ride->update([
            'status' => 'Cancelled'
        ]);

        // cancel all bookings
        $ride->bookings()->update([
            'status' => 'Cancelled'
        ]);

        return back()->with('success', 'Ride cancelled successfully.');
    }

    //user profile
    public function profileShow($id)
    {
        $user = User::findOrFail($id);
        $avgRating = Rating::where('given_to', $id)->avg('rating');
        $totalRatings = Rating::where('given_to', $id)->count();
        $rev = Rating::where('given_to', $id)->get();

        $rides = Ride::where("user_id", $id)->get();
        $bookings = Booking::where("user_id", $id)->get();
        return view('admin.profile', compact('user', 'avgRating', 'totalRatings', 'rev', 'bookings', 'rides'));
    }

    //bookings
    public function indexBook(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $bookings = Booking::with(['user', 'ride'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                    ->orWhereHas('ride', function ($q) use ($search) {
                        $q->where('pickup_address', 'like', "%$search%")
                            ->orWhere('drop_address', 'like', "%$search%");
                    });
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();


        return view('admin.bookings.index', compact('bookings'));
    }

    //reviews
    public function reviews(Request $request)
    {
        $search = $request->search;

        $ratings = Rating::with(['giver', 'givenTo'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('giver', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                    ->orWhereHas('givenTo', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    });
            })
            ->latest()
            ->paginate(6);
        return view('admin.reviews.index', compact('ratings'));
    }

    //review delete
    public function destroy(Rating $review)
    {
        $review->delete();
        return back()->with('success', 'Review removed.');
    }
}
