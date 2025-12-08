<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
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
        return view('resepsionis.reservations.show', compact('reservation'));
    }
}
