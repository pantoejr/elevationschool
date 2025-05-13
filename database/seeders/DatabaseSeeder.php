<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $newUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'pantoejr@gmail.com',
            'password' => bcrypt('P@55w0rd'),
        ]);
        
        
        // Create a role and assign it to the user
        Role::firstOrCreate(['name' => 'Superadmin']);
        $newUser->assignRole('Superadmin');
    }
}
