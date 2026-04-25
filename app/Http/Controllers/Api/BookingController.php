<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     *
     */
    public function index() {
        try {
            $bookings = Booking::with('user')->orderBy('created_at', 'desc')->get();
            
            
            return response()->json([
                'status' => 'success',
                'bookings' => $bookings
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching bookings'], 500);
        }
    }

    /**
     * 
     */
    public function store(Request $request)
    {
      
        $request->validate([
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'guests_count' => 'required|integer|min:1',
        ]);

        try {

            $booking = Booking::create([
                'user_id'      => Auth::id(), 
                'booking_date' => $request->booking_date,
                'booking_time' => $request->booking_time,
                'guests_count' => $request->guests_count ?? 1,
                'status'       => 'pending',
            ]);

            return response()->json([
                'message' => 'Success! Your table has been booked.',
                'booking' => $booking
            ], 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create booking',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}