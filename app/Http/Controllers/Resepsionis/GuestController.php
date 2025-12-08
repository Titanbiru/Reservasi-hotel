<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $guests = User::where('role', 'guest')->paginate(20);
        return view('resepsionis.guests.index', compact('guests'));
    }

    public function create()
    {
        return view('resepsionis.guests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6'
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'role'=>'guest',
            'password'=>bcrypt($request->password)
        ]);

        return redirect()->route('resepsionis.guests.index')->with('success','Tamu berhasil ditambahkan');
    }

    public function edit($id)
    {
        $guest = User::findOrFail($id);
        return view('resepsionis.guests.edit', compact('guest'));
    }

    public function update(Request $request, $id)
    {
        $guest = User::findOrFail($id);

        $guest->update([
            'name'=>$request->name,
            'email'=>$request->email,
        ]);

        return redirect()->route('resepsionis.guests.index')->with('success','Data tamu berhasil diupdate');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success','Tamu berhasil dihapus');
    }
}
