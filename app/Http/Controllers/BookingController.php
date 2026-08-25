<?php

namespace App\Http\Controllers;


use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['event', 'user'])->latest()->paginate(10);
        return response()->json([
            "status" => true,
            "message" => "Bookings fetched successfully",
            "data" => $bookings
        ]);
    }

    public function show(Booking $booking)
    {
        return response()->json([
            "status" => true,
            "message" => "Booking fetched successfully",
            "data" => $booking->load(['event', 'user'])
        ]);
    }

    public function updateStatus(Booking $booking, Request $request)
    {

        $request->validate([
            'status' => 'required|in:confirmed,cancelled,pending'
        ]);
        $booking->update([
            'status' => $request->status
        ]);
        return response()->json([
            "status" => true,
            "message" => "Booking updated successfully",
            "data" => $booking->load(['event', 'user'])
        ]);
    }
}
