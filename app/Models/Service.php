<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'specialist_id'
    ];

    public function specialist()
    {
        return $this->belongsTo(Specialist::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
