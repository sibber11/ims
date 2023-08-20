<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'username' => $this->faker->unique()->userName(),
            'mobile' => $this->faker->unique()->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'intro' => $this->faker->word(),
            'profile' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'email_verified_at' => Carbon::now()
        ];
    }

    public function supplier(){
        return $this->afterCreating(function (User $user) {
            $user->assignRole('supplier');
        });
    }

    public function customer(){
        return $this->afterCreating(function (User $user) {
            $user->assignRole('customer');
        });
    }
}
