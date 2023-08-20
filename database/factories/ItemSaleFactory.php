<?php

namespace Database\Factories;

use App\Models\ItemSale;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ItemSaleFactory extends Factory
{
    protected $model = ItemSale::class;

    public function definition()
    {
        return [
            'price' => $this->faker->randomFloat(),
            'discount' => $this->faker->randomFloat(),
            'quantity' => $this->faker->randomNumber(),
            'content' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
