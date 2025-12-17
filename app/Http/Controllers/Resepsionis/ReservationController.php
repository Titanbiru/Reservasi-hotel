<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:resepsionis']);
    }

    // Daftar reservasi + filter tanggal & pencarian nama tamu
    public function index(Request $request)
    {
        $query = Reservation::with('roomType');

        if ($request->filled('q')) {
            $query->where('guest_name','like','%'.$request->q.'%');
        }

        if ($request->filled('check_in')) {
            $query->whereDate('check_in', $request->check_in);
        }

        $reservations = $query->orderBy('check_in','desc')->paginate(10);
        return view('resepsionis.reservations.index', compact('reservations'));
    }

    // Detail reservasi
    public function show($id)
    {
        $reservation = Reservation::with('roomType')->findOrFail($id);
        $availableRooms = $reservation->roomType->rooms()->where('status','available')->get();

        return view('resepsionis.reservations.show', compact('reservation', 'availableRooms'));
    }
    // Proses check-in
    public function confirm($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->status !== 'pending') {
            return back()->with('error', 'Reservasi tidak dapat dikonfirmasi.');
        }

        $reservation->status = 'confirmed';
        $reservation->save();

        return back()->with('success', 'Reservasi telah dikonfirmasi.');
    }

    public function checkin(Request $request, $id)
    {
        
        $request->validate([
            'room_id' => 'required|exists:rooms,id'
        ]);

        
        $reservation = Reservation::findOrFail($id);
        $room = Room::findOrFail($request->room_id);
        

        // 1. Update reservasi
        $reservation->update([
            'status' => 'checked_in',
            'room_id' => $room->id
        ]);

        // 2. Update kamar
        $room->update([
            'status' => 'occupied'
        ]);

        return redirect()->back()->with('success', 'Tamu berhasil check-in');
    }


    public function checkout($id)
    {
        $reservation = Reservation::findOrFail($id);

        // 1. Pastikan reservasi punya kamar
        if ($reservation->room_id) {

            // 2. Kembalikan status kamar
            Room::where('id', $reservation->room_id)
                ->update(['status' => 'available']);
        }

        // 3. Update reservasi
        $reservation->update([
            'status' => 'check_out',
            'room_id' => null // penting agar tidak nyangkut
        ]);

        return back()->with('success', 'Check-out berhasil');
    }


}
