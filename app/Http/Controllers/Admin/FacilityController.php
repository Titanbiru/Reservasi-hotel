<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;

class FacilityController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']); // pastikan hanya admin
    }

    public function index()
    {
        $facilities = Facility::all();
        return view('admin.facilities.index', compact('facilities'));
    }

    public function create()
    {
        return view('admin.facilities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:hotel,room'
        ]);

        Facility::create($request->only('name','type','description'));
        return redirect()->route('admin.facilities.index')->with('success','Fasilitas berhasil ditambahkan!');
    }

    public function edit(Facility $facility)
    {
        return view('admin.facilities.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:hotel,room'
        ]);

        $facility->update($request->only('name','type','description'));
        return redirect()->route('admin.facilities.index')->with('success','Fasilitas diperbarui!');
    }

    public function destroy(Facility $facility)
    {
        $facility->delete();
        return back()->with('success','Fasilitas dihapus!');
    }
}
