<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'order_number' => 'ORD-' . strtoupper(fake()->bothify('??###')),
            'total_amount' => fake()->randomFloat(2, 10, 2000),
            'status' => fake()->randomElement(['pending', 'completed', 'cancelled']),
            'created_at'   => fake()->dateTimeBetween('-2 year', 'now'),
        ];
    }
}
