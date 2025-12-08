<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;
use App\Models\RoomType;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition()
    {
        return [
            'number' => $this->faker->unique()->numberBetween(101,999),
            'room_type_id' => RoomType::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['available','occupied','maintenance']),
        ];
    }
}
