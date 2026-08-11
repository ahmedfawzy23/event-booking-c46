<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = Category::pluck('id')->toArray();
        $startDate = $this->faker->dateTimeBetween('now', '+3 months');
        $endDate = (clone $startDate)->modify('+' . rand(1, 7) . ' hours');
        $capacity = $this->faker->numberBetween(50, 500);
        $price = $this->faker->randomFloat(2, 10, 1000);

        return [
            "name" => $this->faker->sentence(4),
            "description" => $this->faker->paragraph(3, true),
            "start_date" => $startDate,
            "end_date" => $endDate,
            "location" => $this->faker->address(),
            "price" => $price,
            "capacity" => $capacity,
            "available_seats" => $capacity,
            "image" => $this->faker->imageUrl(),
            "status" => "draft",
            "category_id" => $this->faker->randomElement($categories),
        ];
    }

    public function draft(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => "draft",
        ]);
    }

    public function published(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => "published",
        ]);
    }

    public function cancelled(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => "cancelled",
        ]);
    }

    public function completed(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => "completed",
        ]);
    }
}
