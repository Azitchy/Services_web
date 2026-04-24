<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return Booking::query()->with('property')->latest()->paginate(15);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => ['required', 'exists:properties,id'],
            'source' => ['nullable', 'in:airbnb,pms,manual'],
            'external_booking_id' => ['nullable', 'string', 'max:255', 'unique:bookings,external_booking_id'],
            'guest_name' => ['nullable', 'string', 'max:255'],
            'guest_count' => ['nullable', 'integer', 'min:1', 'max:50'],
            'check_in' => ['required', 'date'],
            'check_out' => ['required', 'date', 'after:check_in'],
            'booking_status' => ['nullable', 'in:confirmed,cancelled,completed'],
            'synced_at' => ['nullable', 'date'],
        ]);

        $booking = Booking::create($validated);

        return response()->json($booking, 201);
    }

    public function show(Booking $booking)
    {
        return $booking->load(['property', 'cleaningJob']);
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'property_id' => ['sometimes', 'exists:properties,id'],
            'source' => ['sometimes', 'in:airbnb,pms,manual'],
            'external_booking_id' => ['nullable', 'string', 'max:255', 'unique:bookings,external_booking_id,'.$booking->id],
            'guest_name' => ['nullable', 'string', 'max:255'],
            'guest_count' => ['sometimes', 'integer', 'min:1', 'max:50'],
            'check_in' => ['sometimes', 'date'],
            'check_out' => ['sometimes', 'date', 'after:check_in'],
            'booking_status' => ['sometimes', 'in:confirmed,cancelled,completed'],
            'synced_at' => ['nullable', 'date'],
        ]);

        $booking->update($validated);

        return $booking->fresh();
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return response()->noContent();
    }
}
