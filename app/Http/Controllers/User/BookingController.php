<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, BookingService $bookingService)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'quantity' => 'required|integer|min:1',
        ]);
        $event = Event::findOrFail($validated['event_id']);

        if ($event->available_seats < $validated['quantity']) {
            return response()->json([
                'message' => 'Not enough seats available',
            ], 400);
        }

        $booking = $bookingService->createBooking($validated, $event, $request);

        return response()->json([
            'message' => 'Booking created successfully',
            'booking' => $booking,
        ]);
    }
}
