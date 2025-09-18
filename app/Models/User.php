<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;   
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;  

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function specialist()
    {
        return $this->hasOne(Specialist::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'client_id');
    }

}
