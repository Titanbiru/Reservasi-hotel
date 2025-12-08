<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RoomType;
use App\Models\Facility;

class RoomTypeFactory extends Factory
{
    protected $model = RoomType::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement(['Superior','Deluxe','Suite']),
            'description' => $this->faker->sentence(),
            'capacity' => $this->faker->numberBetween(1,4),
            'price' => $this->faker->numberBetween(250000,1000000),
            'image' => null,
        ];
    }

    // Setelah dibuat, attach random facilities
    public function configure()
    {
        return $this->afterCreating(function (RoomType $roomType) {
            $facilityIds = Facility::inRandomOrder()->limit(rand(2,4))->pluck('id');
            $roomType->facilities()->sync($facilityIds);
        });
    }
}
