<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\Facility;


class HomeController extends Controller
{
    // Halaman utama
    public function index()
    {
        $roomTypes = RoomType::with('facilities')->get();
        $hotelFacilities = Facility::where('type', 'hotel')->get();

        return view('home', compact('roomTypes', 'hotelFacilities'));
    }

    // Detail tipe kamar
    public function roomTypeDetail($id)
    {
        $roomType = RoomType::with('facilities')->findOrFail($id);
        return view('room_types.detail', compact('roomType'));
    }
}