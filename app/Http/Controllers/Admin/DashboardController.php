<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalRooms'      => Room::count(),
            'totalRoomTypes'  => RoomType::count(),
            'totalUsers'      => User::count()
        ]);
    }
}
