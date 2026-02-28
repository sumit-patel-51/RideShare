<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;
use App\Models\User;

class Ride extends Model
{
    protected $fillable = [
        'user_id',
        'pickup_address',
        'pickup_lat',
        'pickup_lng',
        'drop_address',
        'drop_lat',
        'drop_lng',
        'distance_kg',
        'date',
        'time',
        'price',
        'total_seats',
        'available_seats',
        'vehicle_number',
        'license_number',
        'status',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
