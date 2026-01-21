<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@prime.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->call([
            BrandSeeder::class,
            AttributeSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
