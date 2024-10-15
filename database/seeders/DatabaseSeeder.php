<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->withPersonalTeam()->create();

        User::factory()->withPersonalTeam()->create([
            'name' => 'dieguito',
            'email' => 'diego@gmail.com',
            'password' => '12345678'
        ]);


        $this->call([
            // ... otros seeders
            ReactivoSeeder::class,
            ProveedorSeeder::class,
        ]);
    }
}
