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
            'stock' => $this->faker->numberBetween(1,1000),
            'retail_price' => $this->faker->numberBetween(1,1000),
            'discount' => $this->faker->numberBetween(1,1000),
            'price' => $this->faker->numberBetween(1,1000),
            'quantity_received' => $this->faker->numberBetween(1,1000),
            'sold' => $this->faker->numberBetween(1,1000),
            'available' => $this->faker->numberBetween(1,1000),
            'defective' => $this->faker->numberBetween(1,1000),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'product_id' =>\App\Models\Product::factory(),
            'brand_id' =>\App\Models\Brand::factory(),
            'supplier_id' =>\App\Models\User::factory()->supplier(),
            'order_id' =>\App\Models\Order::factory(),

            'created_by' =>\App\Models\User::factory(),
            'updated_by' => function(array $attributes){
                return $attributes['created_by'];
            }
        ];
    }
}
