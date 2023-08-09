<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        

        \App\Models\User::factory()->create([
            'username' => 'testuser',
            'email' => 'test@example.com',
        ]);

        // \App\Models\Product::factory(10)->create();
        // \App\Models\Category::factory(10)->create();
        // \App\Models\Brand::factory(10)->create();
        // \App\Models\User::factory(10)->create();
        \App\Models\Item::factory(10)->create();

    }
}
