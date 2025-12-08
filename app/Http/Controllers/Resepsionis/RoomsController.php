<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Room;

class RoomsController extends Controller
{
    public function index()
    {
        $rooms = Room::with('roomType')->paginate(20);
        return view('resepsionis.rooms.index', compact('rooms'));
    }

    public function show($id)
    {
        $room = Room::with('roomType')->findOrFail($id);
        return view('resepsionis.rooms.show', compact('room'));
    }
}
