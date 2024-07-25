<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\password;
use function Laravel\Prompts\table;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'user1',
            'email' => 'user@ma.il',
        ]);

        DB::table('users')->insert([
            ['name' => 'user1', 'email' => 'u1@ma.il', 'password' => Hash::make('321654987')],
            ['name' => 'user2', 'email' => 'u2@ma.il', 'password' => Hash::make('321654987')],
            ['name' => 'user3', 'email' => 'u3@ma.il', 'password' => Hash::make('321654987')],
            ['name' => 'user4', 'email' => 'u4@ma.il', 'password' => Hash::make('321654987')],
        ]);

        DB::table('task_statuses')->insert([
            ['name' => 'новый'],
            ['name' => 'в работе'],
            ['name' => 'на тестировании'],
            ['name' => 'завершен'],
        ]);
    }
}
