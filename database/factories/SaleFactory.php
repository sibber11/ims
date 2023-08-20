<?php

namespace Database\Factories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition(): array
    {
        return [
            'total_amount' => $this->faker->randomNumber(),
            'sub_total' => $this->faker->randomNumber(),
            'payment_method' => $this->faker->randomNumber(),
            'payment_status' => $this->faker->randomNumber(),
            'change_given' => $this->faker->randomNumber(),
            'notes' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
