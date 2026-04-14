<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rating;
use App\Models\Ride;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Ride::where('status', 'Upcoming')
            ->where('available_seats', '>', 0);
        //filter if present
        if ($request->pickup) {
            $query = $query->where('pickup_address', 'like', '%' . $request->pickup . '%');
        }
        if ($request->drop) {
            $query = $query->where('drop_address', 'like', '%' . $request->drop . '%');
        }
        if ($request->date) {
            $query = $query->where('date', $request->date);
        }

        $rides = $query->latest()->get();
        return view('dashboard', compact('rides'));
    }

    public function mainDashboardInfo()
    {
        $user = auth()->user();

        $totalRides = Ride::where('user_id', $user->id)->count();

        $completedRides = Ride::where('user_id', $user->id)->where('status', "Completed")->count();

        $totalBookings = Booking::where("user_id", $user->id)->count();

        $avgRating = Rating::where("given_to", $user->id)->avg('rating');

        $recentRides = Ride::where("user_id", $user->id)->latest()->take(5)->get();

        $recentBookings = Booking::where("user_id", $user->id)->with('ride.user')->latest()->take(5)->get();

        return view('mainUSerDashboard', compact('totalRides', 'completedRides', 'totalBookings', 'avgRating', 'recentRides', 'recentBookings'));
    }
}
