<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    private $roles = ['supplier', 'admin', 'customer', 'seller'];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->roles as $role){
            Role::create(['name' => $role]);
        }
    }
}
