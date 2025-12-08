<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'capacity',
        'price',
        'image'
    ];

    //Relasi ke tabel rooms
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    //Relasi ke tabel facilities (many-to-many)
    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'room_type_facility');
    }

    //Relasi ke reservasi
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
