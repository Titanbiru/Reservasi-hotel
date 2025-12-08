<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        return view('resepsionis.dashboard', [
            'totalReservasiToday' => Reservation::whereDate('created_at', Carbon::today())->count(),
            'kamarTersedia'       => Room::where('status', 'available')->count(),
            'kamarTerisi'         => Room::where('status', 'booked')->count()
        ]);
    }
}
