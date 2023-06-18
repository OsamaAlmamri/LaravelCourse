<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\MechanicFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//       $this->call([
//          CategorySeeder::class,
//           MechanicSeeder::class,
//       ]);
         \App\Models\User::factory(10)->create();
        // \App\Models\Post::factory(10)->create();
     //    \App\Models\Comment::factory(150)->create();
        // \App\Models\Color::factory(10)->create();
         \App\Models\CarColor::factory(100)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
