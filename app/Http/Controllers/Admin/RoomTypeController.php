<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\RoomType;

class RoomTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }

    public function index()
    {
        $roomTypes = RoomType::all();
        return view('admin.room_types.index', compact('roomTypes'));
    }

    public function create()
    {
        return view('admin.room_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->only('name','description','price','capacity');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('room_types','public');
        }

        RoomType::create($data);
        return redirect()->route('admin.room-types.index')->with('success','Tipe kamar berhasil ditambahkan!');
    }

    public function edit(RoomType $roomType)
    {
        return view('admin.room_types.edit', compact('roomType'));
    }

    public function update(Request $request, RoomType $roomType)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->only('name','description','price','capacity');

        if ($request->hasFile('image')) {
            if ($roomType->image) {
                Storage::disk('public')->delete($roomType->image);
            }
            $data['image'] = $request->file('image')->store('room_types','public');
        }

        $roomType->update($data);
        return redirect()->route('admin.room-types.index')->with('success','Tipe kamar diperbarui!');
    }

    public function destroy(RoomType $roomType)
    {
        if ($roomType->image) Storage::disk('public')->delete($roomType->image);
        $roomType->delete();
        return back()->with('success','Tipe kamar dihapus!');
    }
}
