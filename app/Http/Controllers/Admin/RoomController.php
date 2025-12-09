<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $show = $request->input('show', 50);

        if ($show === 'all') {
            $rooms = Room::all(); // tanpa pagination
        } else {
            $rooms = Room::paginate($show);
        }

        return view('admin.rooms.index', compact('rooms',  'show'));
    }

    public function create()
    {
        $roomTypes = RoomType::all();
        return view('admin.rooms.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_type_id' => 'required',
            'number' => 'required|unique:rooms,number',
            'status' => 'required'
        ]);

        Room::create([
            'room_type_id' => $request->room_type_id,
            'number' => $request->number,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.rooms.index')->with('success','Room berhasil ditambahkan');
    }

    public function edit(Room $room)
    {
        $roomTypes = RoomType::all();
        return view('admin.rooms.edit', compact('room','roomTypes'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room_type_id' => 'required',
            'number' => 'required|unique:rooms,number,'.$room->id,
            'status' => 'required'
        ]);

        $room->update([
            'room_type_id' => $request->room_type_id,
            'number' => $request->number,
            'status' => $request->status,
        ]); 
        
        return redirect()->route('admin.rooms.index')->with('success','Room berhasil diupdate');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success','Room berhasil dihapus');
    }
}
