<?php

namespace Database\Factories;

use App\Models\ProductMeta;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductMetaFactory extends Factory
{
    protected $model = ProductMeta::class;

    public function definition()
    {
        return [
            'product_id' => $this->faker->randomNumber(),
            'key' => $this->faker->word(),
            'content' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
