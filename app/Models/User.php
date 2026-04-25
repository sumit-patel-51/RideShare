<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Booking;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'image',
        'license_no',
        'vehicle_no',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    //roles
    const ROLE_USER = 1;
    const ROLE_ADMIN = 2;

    public function isAdmin()
    {
        return $this->role == self::ROLE_ADMIN;
    }

    public function isUser()
    {
        return $this->role == self::ROLE_USER;
    }

    
    public function rides()
    {
        return $this->hasMany(Ride::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function ratingsGiven()
    {
        return $this->hasMany(Rating::class, 'given_by');
    }

     public function givenTo()
    {
        return $this->hasMany(Rating::class, 'given_to');
    }
}
