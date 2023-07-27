<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'mobile' => $this->faker->word(),
            'email' => $this->faker->unique()->safeEmail(),
            'line_1' => $this->faker->word(),
            'line_2' => $this->faker->word(),
            'city' => $this->faker->city(),
            'province' => $this->faker->word(),
            'country' => $this->faker->country(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
