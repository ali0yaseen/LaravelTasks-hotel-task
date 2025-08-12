<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Room $room)
    {
        $room->load('hotel');
        return view('bookings.create', compact('room'));
    }

    public function store(Request $request, Room $room)
    {
        $data = $request->validate([
            'check_in'  => ['required','date','after_or_equal:today'],
            'check_out' => ['required','date','after:check_in'],
        ]);

        // فحص التداخل: (startA < endB) && (endA > startB)
        $hasOverlap = $room->bookings()
            ->where('status', '!=', 'cancelled')
            ->where(function($q) use ($data) {
                $q->where('check_in', '<',  $data['check_out'])
                  ->where('check_out','>', $data['check_in']);
            })->exists();

        if ($hasOverlap) {
            return back()->withErrors([
                'check_in' => 'الغرفة محجوزة ضمن هذه التواريخ. جرّب مواعيد أخرى.'
            ])->withInput();
        }

        Booking::create([
            'user_id'   => auth()->id() ?? 1,   // مؤقتًا: 1 للمستخدم التجريبي
            'room_id'   => $room->id,
            'check_in'  => $data['check_in'],
            'check_out' => $data['check_out'],
            'status'    => 'pending',
        ]);

        return redirect()->route('hotels.show', $room->hotel_id)
            ->with('success', 'تم إنشاء الحجز (قيد التأكيد).');
    }
}
