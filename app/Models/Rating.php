<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'ride_id',
        'given_by',
        'given_to',
        'rating',
        'review',
    ];

    public function ratingsGiven() {
        return $this-> hasMany(Ride::class,'givin_by');
    }

    public function ratingsReceived() {
        return $this-> hasMany(Ride::class,'givin_to');
    }

    public function giver()
    {
        return $this->belongsTo(User::class, 'given_by');
    }
}
