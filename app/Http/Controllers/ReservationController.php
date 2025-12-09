<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\str;
use App\Models\Reservation;
use App\Models\RoomType;
use Carbon\carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class ReservationController extends Controller
{
    //menampilkan form reservasi

    public function create(RoomType $room_type)
    {
        return view('reservation.create', compact('room_type'));
    }

    //simpan  data reservasi

    public function store(Request $request)
    {
        
        $request->validate([
            'guest_name'    => ['required', 'string', 'max:100'],
            'guest_email'   => ['required', 'email'],
            'guest_phone'   => ['required', 'string', 'max:20'],
            'check_in'      => ['required', 'date', 'after_or_equal:today'],
            'check_out'     => ['required', 'date', 'after:check_in'],
            'room_type_id'  => ['required', 'exists:room_types,id'],
            'room_count'    => ['required', 'integer', 'min:1'],
        ]);

        $roomType = RoomType::findOrFail($request->room_type_id);

        $availableRooms = $roomType->rooms()->where('status','available')->count();
        if ($request->room_count > $availableRooms) {
            return back()->withErrors(['room_count'=>'Jumlah kamar melebihi yang tersedia.'])->withInput();
        }

        $days = Carbon::parse($request->check_in)->diffInDays(Carbon::parse($request->check_out));
        $total = $days * $roomType->price * $request->room_count;

        do {
            $code = strtoupper(Str::random(6));
        } while (Reservation::where('reservation_code', $code)->exists());

        $reservation = Reservation::create([
            'user_id'        => auth()->id(), // wajib login
            'guest_name'     => $request->guest_name,
            'guest_email'    => $request->guest_email,
            'guest_phone'    => $request->guest_phone,
            'room_type_id'   => $roomType->id,
            'check_in'       => $request->check_in,
            'check_out'      => $request->check_out,
            'room_count'     => $request->room_count,
            'total_price'    => $total,
            'status'         => 'pending',
            'reservation_code' => $code,
        ]);

        return redirect()->route('reservation.print', $reservation->reservation_code);
    }

    public function myReservations()
    {
        $reservations = Reservation::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reservation.history', compact('reservations'));
    }


    //cetak bukti reservasi
    public function print($code)
    {
        $reservation = Reservation::where('reservation_code', $code)
            ->where('user_id', auth()->id()) // pastikan hanya pemilik yang bisa mencetak
            ->firstOrFail();

        return view('reservation.print', compact('reservation'));
    }

    public function pdf($code)
    {
        $reservation = Reservation::where('reservation_code', $code)->firstOrFail();

        $pdf = Pdf::loadView('reservation.pdf', compact('reservation'))->setPaper('A4');

        return $pdf->download('Bukti-Reservasi-'.$reservation->reservation_code.'.pdf');
    }
}
