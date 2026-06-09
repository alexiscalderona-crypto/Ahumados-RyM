<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Administrador',
            'email' => 'admin@ahumadosrym.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Cliente',
            'email' => 'cliente@ahumadosrym.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);
        
        $this->call(StoreSeeder::class);
    }
}
