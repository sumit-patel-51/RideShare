<?php

namespace App\Http\Controllers;

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
}
