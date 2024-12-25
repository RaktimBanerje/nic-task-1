<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the 'Head Master' role (admin role)
        Role::create(['name' => 'head_master']);

        // Create the 'Teacher' role
        Role::create(['name' => 'teacher']);
    }
}
