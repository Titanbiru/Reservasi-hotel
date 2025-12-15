<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']); // pastikan hanya admin
    }

    public function index()
    {
        $facilities = Facility::orderby('created_at','desc')->paginate(10);
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
            'type' => 'required|in:hotel,room',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048' // Maks 2MB
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')
                ->store('facilities', 'public');
        }

        Facility::create([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'image' => $imagePath,
            'is_active' => true,
        ]);

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
            'type' => 'required|in:hotel,room',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048' // Maks 2MB
        ]);

        if ($request->hasFile('image')) {
            if ($facility->image) {
                Storage::disk('public')->delete($facility->image);
            }
            $imagePath = $request->file('image')
                ->store('facilities', 'public');
        }

        $facility->update([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'image' => $request->hasFile('image') ? $imagePath : $facility->image,
        ]);

        return redirect()->route('admin.facilities.index')->with('success','Fasilitas diperbarui!');
    }

    public function destroy(Facility $facility)
    {
        if ($facility->image) {
            Storage::disk('public')->delete($facility->image);
        }
        $facility->delete();
        return back()->with('success','Fasilitas dihapus!');
    }
}
