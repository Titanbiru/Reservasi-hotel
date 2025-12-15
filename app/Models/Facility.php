<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type', // 'room' atau 'hotel'
        'image',
        'is_active'
    ];

    //Relasi ke RoomType lewat pivot
    public function roomTypes()
    {
        return $this->belongsToMany(RoomType::class, 'room_type_facility');
    }

    public function scopeHotelFacility()
    {
        return $query->where('type', 'hotel');
    }
}
