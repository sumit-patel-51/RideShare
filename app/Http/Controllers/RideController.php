<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rating;
use App\Models\Ride;
use Illuminate\Http\Request;

class RideController extends Controller
{
    //post ride page
    public function create()
    {
        $user = auth()->user();
        return view("rides.create", compact('user'));
    }

    //store ride
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

        //if user license and vehicle no not exist
        $user = auth()->user();
        if (!$user->license_no || !$user->vehicle_no) {
            $user->license_no = $request->license_number;
            $user->vehicle_no = $request->vehicle_number;
            $user->save();
        }
        return redirect('/dashboard')->with('success', 'Ride Posted Successfully!');
    }

    //myRide page
    public function myRides()
    {
        $rides = auth()->user()->rides()->get();
        return view('rides.my', compact('rides'));
    }

    //passenger view
    public function passengers(Ride $ride)
    {
        if ($ride->user_id != auth()->id()) {
            return back()->with('error', 'Unauthorized access');
        }

        $bookings = $ride->bookings()->whereIn("status", ['Confirmed' ,'Ongoing'])->get();
        return view('rides.passengers', compact('ride', 'bookings'));
    }

    //ride edit page
    public function edit(Ride $ride)
    {
        if ($ride->user_id != auth()->id()) {
            return back()->with("error", 'Unauthorized');
        }
        return view('rides.edit', compact('ride'));
    }

    //save update of ride
    public function update(Request $req, Ride $ride)
    {
        $req->validate([
            'date' => 'required',
            'time' => 'required',
            'price' => 'required|numeric',
            'total_seats' => 'required|integer|min:1',
        ]);

        $bookedSeats = $ride->total_seats - $ride->available_seats;
        if ($req->total_seats < $bookedSeats) {
            return back()->with('error', 'Cannot reduce seats below already booked seats.');
        }

        $ride->available_seats = $req->total_seats - $bookedSeats;

        $ride->update([
            'date' => $req->date,
            'time' => $req->time,
            'price' => $req->price,
            'total_seats' => $req->total_seats,
            'available_seats' => $ride->available_seats,
        ]);

        return redirect()->route('rides.my')->with('success', 'Ride updated successfully!');
    }

    //cancel Ride
    public function cancelRide(Ride $ride)
    {
        if ($ride->user_id != auth()->id()) {
            return back()->with('error', 'Unautharized');
        }

        $ride->update(['status' => "Cancelled"]);

        foreach ($ride->bookings as $booking)
            $booking->update(["status" => "Cancelled"]);

        return back()->with("success", "Ride Cancelled Successfully!");
    }

    //complete ride
    public function completeRide(Ride $ride)
    {
        if ($ride->user_id != auth()->id())
            return back()->with('error', 'Unautharized');

        $ride->update(['status' => 'Completed']);

        foreach ($ride->bookings as $booking) {
            if ($booking->status == 'Confirmed' || $booking->status == 'Ongoing') {
                $booking->update(['status' => 'Completed']);
            }
        }
        return back()->with("success", "Ride Completed!");
    }
    //Ongoing ride
    public function ongoingRide(Ride $ride)
    {
        if ($ride->user_id != auth()->id())
            return back()->with('error', 'Unautharized');

        if($ride->status == 'Ongoing'){
            return back()->with('error', 'Ride Already Started!');
        }

        $ride->update(['status' => 'Ongoing']);

        foreach ($ride->bookings as $booking) {
            if ($booking->status == 'Confirmed') {
                $booking->update(['status' => 'Ongoing']);
            }
        }
        return back()->with("success", "Ride is Ongoing!");
    }

    //show ride detail
    public function rideDetailShow($id)
    {
        $ride = Ride::with('user')->findOrFail($id);
        //if own ride
        if ($ride->user_id == auth()->id()) {
            return back()->with('error', "You Can't Book Your Own Ride.");
        }
        $avgRating = Rating::where('given_to', $ride->user_id)->avg('rating');
        return view('rides.showDetail', compact('ride', 'avgRating'));
    }
    //book ride
    public function book(Request $req, Ride $ride)
    {
        $req->validate([
            'pickup_address' => 'required|string|max:255',
            'drop_address' => 'required|string|max:255',
            'seats_booked' => 'required|integer|min:1'
        ]);

        //return if ride is completed and cancelled
        if ($ride->status !== 'Upcoming') {
            return back()->with('error', 'Ride not available.');
        }
        //already booked user not book again
        $alreadyBooked = Booking::where('ride_id', $ride->id)->where('status', 'Confirmed')->where('user_id', auth()->id())->exists();
        if ($alreadyBooked)
            return back()->with('error', 'You already booked this ride.');

        //check available seats
        if ($ride->available_seats < $req->seats_booked) {
            return back()->with("error", "Not enough seats Available.");
        }


        //create booking
        Booking::create([
            'ride_id' => $ride->id,
            'user_id' => auth()->id(),
            'pickup_address' => $req->pickup_address,
            'drop_address' => $req->drop_address,
            'seats_booked' => $req->seats_booked,
            'status' => 'Confirmed'
        ]);

        //reduce available seats
        $ride->decrement('available_seats', $req->seats_booked);

        return redirect('my-bookings')->with('success', 'Ride Booked Successfully!');
    }

    //my Boocking
    public function myBookings()
    {
        $bookings = auth()->user()->bookings()->latest()->get();

        return view('rides.bookings', compact('bookings'));
    }

    //booking detail page
    public function showDetail($id)
    {
        $booking = Booking::with('ride.user', 'ride.bookings')->findOrFail($id);
        $driverId = $booking->ride->user->id;

        $avgRating = Rating::where('given_to', $driverId)->avg('rating');

        $alreadyRated = Rating::where("given_to", $driverId)->where('given_by', auth()->id())->exists();

        return view('rides.bookingDetails', compact('booking', 'alreadyRated', 'avgRating'));
    }

    //cancel booking
    public function cancelBooking(Booking $booking)
    {
        if ($booking->user_id != auth()->id()) {
            return back()->with('error', 'Unauthorize action.');
        }

        if ($booking->status == 'Cancelled') {
            return back()->with('error', 'Booking Already Cancelled.');
        }

        $booking->update(['status' => 'Cancelled']);

        $booking->ride->increment('available_seats', $booking->seats_booked);

        return back()->with('success', 'Booking cancelled Successfullt!');
    }

}
