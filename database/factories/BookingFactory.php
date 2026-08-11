<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::pluck('id')->toArray();
        $event = Event::pluck('id')->toArray();

        return [
            "user_id" => $this->faker->randomElement($users),
            "event_id" => $this->faker->randomElement($event),
            "quantity" => $this->faker->numberBetween(1, 10),
            "total_price" => $this->faker->randomFloat(2, 10, 5000),
            "status" => "pending",
        ];
    }
}
