<?php

namespace App\services;

use Illuminate\Support\Facades\DB;

class BookingService
{
    /**
     * Create a new class instance.
     */
    public function createBooking($validated, $event, $request)
    {
        return DB::transaction(function () use ($validated, $event, $request) {
            $event->lockForUpdate();
            $booking = $request->user()->bookings()->create([
                'event_id' => $validated['event_id'],
                'quantity' => $validated['quantity'],
                'total_price' => $event->price * $validated['quantity'],
            ]);

            $event->decrement('available_seats', $validated['quantity']);

            return $booking;
        });
    }
}
