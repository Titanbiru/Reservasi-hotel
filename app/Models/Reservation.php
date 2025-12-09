<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'guest_name',
        'guest_email',
        'guest_phone',
        'room_type_id',
        'check_in',
        'check_out',
        'room_count',
        'total_price',
        'status',
        'reservation_code'
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    //Buat accessor untuk durasi menginap
    public function getDurationAttribute()
    {
        return \Carbon\Carbon::parse($this->check_in)
            ->diffInDays(\Carbon\Carbon::parse($this->check_out));
    }

    public function availableRooms($checkIn, $checkOut)
{
    return $this->rooms()->where('status', 'available')
        ->whereDoesntHave('reservations', function($q) use ($checkIn, $checkOut) {
            $q->where(function($q2) use ($checkIn, $checkOut) {
                $q2->whereBetween('check_in', [$checkIn, $checkOut])
                    ->orWhereBetween('check_out', [$checkIn, $checkOut]);
            });
        })->get();
}

}
