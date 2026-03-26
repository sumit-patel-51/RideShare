<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $req, $rideId)
    {
        $req->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string'
        ]);

        $ride = Ride::with('bookings')->findOrFail($rideId);

        if ($ride->status != 'Completed') {
            return back()->with('error', 'Ride not completed yet.');
        }

        $alreadyRated = Rating::where('ride_id', $rideId)->where('given_by', auth()->id())->exists();

        if ($alreadyRated) {
            return back()->with('error', 'You Already Rated.');
        }


        //passenger to driver
        Rating::create([
            'ride_id' => $rideId,
            'given_by' => auth()->id(),
            'given_to' => $ride->user_id,
            'rating' => $req->rating,
            'review' => $req->review,
        ]);

        return back()->with('success', 'Rating Submited!');
    }

    public function profileShow($id)
    {
        $user = User::findOrFail($id);
        $avgRating = Rating::where('given_to',$id)->avg('rating');
        $totalRatings = Rating::where('given_to',$id)->count();
        $rev = Rating::where('given_to',$id)->get();
        return view('rides.driverProfile', compact('user', 'avgRating', 'totalRatings', 'rev'));
    }
}
