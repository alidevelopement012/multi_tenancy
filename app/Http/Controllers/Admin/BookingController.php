<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slot;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    public function indexCalendar(Request $request)
    {
        // show public calendar of upcoming slots for this tenant
        $tenantId = Auth::id();
        $slots = Slot::where('tenant_id', $tenantId)
            ->where('active', true)
            ->where('end_at', '>=', now())
            ->orderBy('start_at', 'asc')
            ->get();

        return view('admin.booking.calendar', compact('slots'));
    }

    /**
     * AJAX: check availability for a slot id
     * returns {available: true/false, available_count: int}
     */
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'slot_id' => 'required|exists:slots,id',
            'quantity' => 'nullable|integer|min:1'
        ]);
        $slot = Slot::findOrFail($request->slot_id);
        $quantity = $request->quantity ?? 1;

        return response()->json([
            'available' => $slot->isAvailable($quantity),
            'available_count' => $slot->availableCount(),
            'slot' => $slot
        ]);
    }

    /**
     * Book from checkout or booking form
     * expected payload: slot_id, quantity, meta (json: name,email,phone,order_id?)
     */
    public function book(Request $request)
    {
        $data = $request->validate([
            'slot_id' => 'required|exists:slots,id',
            'quantity' => 'nullable|integer|min:1',
            'meta' => 'nullable|array'
        ]);

        $slot = Slot::findOrFail($data['slot_id']);
        $quantity = $data['quantity'] ?? 1;

        // Basic availability check inside transaction to avoid race conditions
        $booking = null;
        DB::transaction(function () use ($slot, $quantity, $data, &$booking) {

            $slot->refresh(); // reload counts
            if (! $slot->isAvailable($quantity)) {
                throw ValidationException::withMessages(['slot' => 'Selected slot does not have enough capacity.']);
            }

            $booking = Booking::create([
                'tenant_id' => $slot->tenant_id,
                'slot_id' => $slot->id,
                'user_id' => Auth::id(),
                'status' => 'confirmed',
                'quantity' => $quantity,
                'meta' => $data['meta'] ?? [],
                'booked_at' => now(),
            ]);
        });

        // try {
        //     Mail::send(new BookingConfirmed($booking));
        // } catch (\Exception $e) {
        //     Log::error('Booking email failed: '.$e->getMessage());
        // }

        $booking = Booking::orderBy('created_at', 'desc')->first();
        Session::flash('success', 'Booking cancelled!');
        return response()->json([
            'success' => true,
            'booking_id' => $booking->id,
            'message' => 'Booked successfully'
        ]);
    }

    public function index()
    {
        $bookings = Booking::all();
        return view('admin.booking.index', compact('bookings'));
    }

    public function cancel(Request $request, Booking $booking)
    {
        // permission checks: user or tenant admin
        // if ($booking->user_id !== auth()->id() && ! auth()->user()->hasRole('admin')) {
        //     abort(403);
        // }
        $booking->update(['status' => 'canceled']);
        // optionally send email
        return back()->with('success','Booking cancelled.');
    }
}
