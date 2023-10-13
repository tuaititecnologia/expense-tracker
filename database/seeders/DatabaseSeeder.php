<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(CategorySeeder::class);

        \App\Models\User::factory()->create([
            'name' => 'Alejandro Sanchez',
            'email' => 'alejandro.sanchez@tuaiti.com.ar',
            'password' => '$2y$10$x2Uffur9fdtfysinqtzjwuK.Xki2THkpjGqeUL9OrJHrN5P.MEWxG',
        ]);

        \App\Models\User::factory(4)->create();


        $this->call(ExpenseSeeder::class);
    }
}
