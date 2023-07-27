<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition()
    {
        return [
            'stock' => $this->faker->word(),
            'retail_price' => $this->faker->word(),
            'discount' => $this->faker->word(),
            'price' => $this->faker->word(),
            'quantity_received' => $this->faker->word(),
            'sold' => $this->faker->word(),
            'available' => $this->faker->word(),
            'defective' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
