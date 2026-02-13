<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $bookings = $user->bookings()->with(['trip', 'seat'])->get();

        return view('profile.index', compact('user', 'bookings'));
    }

    public function pay(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'У вас нет доступа к этой оплате.');
        }

        if ($booking->status === 'paid') {
            return back()->with('error', 'Эта бронь уже оплачена.');
        }

        // Имитация ошибки 50/50
        $success = rand(1, 4);

        if ($success > 2) {
            $booking->status = 'paid';
            $booking->save();

            return back()->with('success', 'Оплата прошла успешно! ');
        } else {
            return back()->with('error', 'Не удалось оплатить! ');
        }
    }

}
