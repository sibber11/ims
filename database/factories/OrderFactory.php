<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomNumber(),
            'status' => $this->faker->randomNumber(),
            'sub_total' => $this->faker->randomFloat(),
            'item_discount' => $this->faker->randomFloat(),
            'tax' => $this->faker->randomFloat(),
            'shipping' => $this->faker->randomFloat(),
            'total' => $this->faker->randomFloat(),
            'promo' => $this->faker->word(),
            'promo_discount' => $this->faker->randomFloat(),
            'grand_total' => $this->faker->randomFloat(),
            'content' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
