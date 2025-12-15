<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }

    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'title' => 'nullable|string|max:100',
            'subtitle' => 'nullable|string|max:255'
        ]);

        $path = $request->file('image')->store('banners','public');

        Banner::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image' => $path,
            'is_active' => true
        ]);

        return redirect()->route('admin.banners.index');
    }

    public function toggle($id)
    {
        $banner = Banner::findOrFail($id);

        // Kalau mau mengaktifkan
        if (!$banner->is_active) {

            $activeCount = Banner::where('is_active', true)->count();

            if ($activeCount >= 5) {
                return back()->with('error', 'Maksimal 5 banner aktif!');
            }
        }

        $banner->is_active = !$banner->is_active;
        $banner->save();

        return back()->with('success', 'Status banner diperbarui');
    }


    public function destroy(Banner $banner)
    {
        Storage::disk('public')->delete($banner->image);
        $banner->delete();
        return back();
    }
}

