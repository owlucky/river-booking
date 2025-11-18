<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Seat;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Trip::query();

        // Если введено слово для поиска — фильтруем
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $trips = $query->get();

        return view('booking.index', compact('trips'));
    }


    public function show($tripId)
    {
        $trip = Trip::findOrFail($tripId);
        $seats = Seat::all();
        $bookedSeats = Booking::where('trip_id', $tripId)->pluck('seat_id')->toArray();

        return view('booking.show', compact('trip', 'seats', 'bookedSeats'));
    }

    public function store(Request $request, $tripId)
    {
        $validated = $request->validate([
            'seat_id' => 'required|exists:seats,id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
        ]);

        // Проверка, занято ли место
        if (Booking::where('trip_id', $tripId)->where('seat_id', $validated['seat_id'])->exists()) {
            return back()->with('error', 'Это место уже забронировано.');
        }

        Booking::create([
            'trip_id' => $tripId,
            'seat_id' => $validated['seat_id'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone' => $validated['phone'],
            'user_id' => Auth::id(),
        ]);



        return back()->with('success', 'Место успешно забронировано!');
    }
}

