<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::beginTransaction();
        $this->call([
            RoleSeeder::class,
            CustomerSeeder::class,
            OrderSeeder::class
        ]);
        \App\Models\User::factory()->create([
            'username' => 'test_user',
            'email' => 'test@example.com',
        ]);

        // \App\Models\Product::factory(10)->create();
        // \App\Models\Category::factory(10)->create();
        // \App\Models\Brand::factory(10)->create();
        // \App\Models\User::factory(10)->create();
        DB::commit();

    }
}
