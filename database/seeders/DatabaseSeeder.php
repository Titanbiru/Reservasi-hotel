<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\Facility;
use App\Models\Reservation;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        // Users: admin & resepsionis
        // Admin
        User::factory()->create([
            'name' => 'Admin Hotel',
            'email' => 'admin@hotel.com',
            'role' => 'admin',
            'password' => bcrypt('12345678')
        ]);

        // Resepsionis
        User::factory()->create([
            'name' => 'Resepsionis Hotel',
            'email' => 'resepsionis@hotel.com',
            'role' => 'resepsionis',
            'password' => bcrypt('12345678')
        ]);

        // Facilities: hotel + room
        // Bisa 6 fasilitas acak
        Facility::factory()->count(6)->create();

        // RoomTypes + Rooms
        // Misal 3 tipe kamar
        RoomType::factory()
            ->count(3)
            ->create()
            ->each(function ($roomType) {
                // Setiap tipe kamar punya 3-3 kamar
                Room::factory()->count(rand(3,3))
                    ->for($roomType)
                    ->create();
            });

        // Reservations
        Reservation::factory()->count(2)->create();

    }
}
