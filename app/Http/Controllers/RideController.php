<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ride;
use Illuminate\Http\Request;

class RideController extends Controller
{
    public function create()
    {
        return view("rides.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "pickup_address" => "required",
            "drop_address" => "required",
            "date" => "required",
            "time" => "required",
            "price" => "required|numeric",
            "total_seats" => "required|integer",
            "vehicle_number" => "required",
            "license_number" => "required",
        ]);

        Ride::create([
            'user_id' => auth()->id(),
            "pickup_address" => $request->pickup_address,
            'pickup_lat' => 0,
            'pickup_lng' => 0,
            "drop_address" => $request->drop_address,
            'drop_lat' => 0,
            'drop_lng' => 0,
            'distance_kg' => 0,
            "date" => $request->date,
            "time" => $request->time,
            "price" => $request->price,
            "total_seats" => $request->total_seats,
            "available_seats" => $request->total_seats,
            "vehicle_number" => $request->vehicle_number,
            "license_number" => $request->license_number,
            "status" => 'Upcoming',
        ]);
        return redirect('/dashboard')->with('success', 'Ride Posted Successfully!');
    }

    //myRide page
    public function myRides()
    {
        Ride::where('status', 'Cancelled')
            ->where('created_at', '<', now()->subDays(3))
            ->delete();
        $rides = auth()->user()->rides()->latest()->get();
        return view('rides.my', compact('rides'));
    }

    //passenger view
    public function passengers(Ride $ride)
    {
        if ($ride->user_id != auth()->id()) {
            return back()->with('error', 'Unauthorized access');
        }

        $booking = $ride->bookings()->get();
        $bookings = $booking->where("status", 'Confirmed');
        return view('rides.passengers', compact('ride', 'bookings'));
    }

    //cancel Ride
    public function cancelRide(Ride $ride)
    {
        if ($ride->user_id != auth()->id()) {
            return back()->with('error', 'Unautharized');
        }

        $ride->update(['status' => "Cancelled"]);

        foreach ($ride->bookings as $booking) {
            $booking->update(["status" => "Cancelled"]);
        }

        return back()->with("success", "Ride Cancelled Successfully!");
    }

    public function book(Ride $ride)
    {
        // if own ride
        if ($ride->user_id == auth()->id()) {
            return back()->with('error', "You Can't Book Your Own Ride.");
        }
        //check available seats
        if ($ride->available_seats < 1) {
            return back()->with("error", "No seats Available.");
        }
        //create booking
        Booking::create([
            'ride_id' => $ride->id,
            'user_id' => auth()->id(),
            'seat_booked' => 1,
            'status' => 'Confirmed'
        ]);

        //reduce available seats
        $ride->decrement('available_seats');

        return back()->with('success', 'Ride Booked Successfully!');
    }

    public function myBookings()
    {
        $bookings = auth()->user()->bookings()->latest()->get();

        return view('rides.bookings', compact('bookings'));
    }

    //cancel booking
    public function cancelBooking(Booking $booking)
    {
        if ($booking->user_id != auth()->id()) {
            return back()->with('error', 'Unauthorize action.');
        }

        if ($booking->statuc == 'Cancelled') {
            return back()->with('error', 'Booking Already Cancelled.');
        }

        $booking->update(['status' => 'Cancelled']);

        $booking->ride()->increment('available_seats');

        return back()->with('success', 'Booking cancelled Successfullt!');
    }
}
