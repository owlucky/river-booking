<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'seat_id',
        'first_name',
        'last_name',
        'phone',
        'user_id',
        'status'
    ];

    // Связь с поездкой
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    // Связь с местом
    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }

    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
