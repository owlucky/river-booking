<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripAdminController extends Controller
{
    public function create()
    {
        return view('admin.trip-create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'departure_at' => 'required|date',
        ]);

        Trip::create($request->only('title', 'description', 'departure_at'));

        return redirect()->route('booking.index')
            ->with('success', 'Путешествие добавлено!');
    }
    public function edit($id)
    {
        $trip = Trip::findOrFail($id);
        return view('admin.edit', compact('trip'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'departure_at' => 'required|date',
        ]);

        $trip = Trip::findOrFail($id);
        $trip->update($request->only('title', 'description', 'departure_at'));

        return redirect()->route('booking.index')->with('success', 'Путешествие обновлено!');
    }

    public function destroy($id)
    {
        Trip::findOrFail($id)->delete();

        return redirect()->route('booking.index')->with('success', 'Путешествие удалено!');
    }

}
