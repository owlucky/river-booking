<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // получаем все бронирования пользователя
        $bookings = $user->hasMany(\App\Models\Booking::class, 'first_name', 'name')
            ->get();

        return view('profile.index', compact('user', 'bookings'));
    }
}
