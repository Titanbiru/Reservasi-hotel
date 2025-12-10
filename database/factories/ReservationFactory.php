<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Reservation;
use App\Models\RoomType;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition()
    {
        $userIds = User::pluck('id')->toArray();

        $check_in = $this->faker->dateTimeBetween('now', '+1 month');
        $check_out = (clone $check_in)->modify('+'.rand(1,5).' days');

        $roomType = RoomType::inRandomOrder()->first();

        return [
            'user_id' => $this->faker->randomElement($userIds),
            'guest_name' => $this->faker->name(),
            'guest_email' => $this->faker->safeEmail(),
            'guest_phone' => $this->faker->phoneNumber(),
            'room_type_id' => $roomType->id,
            'check_in' => $check_in,
            'check_out' => $check_out,
            'room_count' => rand(1,2),
            'total_price' => $roomType->price * rand(1,2) * Carbon::parse($check_in)->diffInDays(Carbon::parse($check_out)),
            'status' => $this->faker->randomElement(['pending','confirmed','checked_in','cancelled']),
            'reservation_code' => strtoupper(Str::random(6)),
        ];
    }
}
