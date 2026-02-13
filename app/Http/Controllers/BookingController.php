<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Seat;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $request->validate([
            'seat_ids' => 'required|array|min:1',
            'seat_ids.*' => 'exists:seats,id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
        ]);

        $action = $request->input('action', 'reserve');

        try {
            DB::beginTransaction();

            $createdBookings = [];

            foreach ($request->seat_ids as $seatId) {

                if (Booking::where('trip_id', $tripId)->where('seat_id', $seatId)->exists()) {
                    throw new \Exception("Место $seatId уже забронировано.");
                }

                $booking = Booking::create([
                    'trip_id'    => $tripId,
                    'seat_id'    => $seatId,
                    'first_name' => $request->first_name,
                    'last_name'  => $request->last_name,
                    'phone'      => $request->phone,
                    'user_id'    => Auth::id(),
                    'status'     => 'unpaid',
                ]);

                $createdBookings[] = $booking;

                if ($action === 'pay') {


                    $success = rand(1, 4);

                    if ($success <= 2) {

                        throw new \Exception("Ошибка оплаты! Операция отменена.");
                    }


                    $booking->status = 'paid';
                    $booking->save();
                }
            }

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }

        if ($action === 'reserve') {
            return back()->with('success', 'Места успешно забронированы!');
        }

        if ($action === 'pay') {
            return back()->with('success', 'Все места забронированы и успешно оплачены!');
        }
    }





}

