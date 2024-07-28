<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Task;
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
        $now = now();

        DB::table('users')->insert([
            ['name' => 'user1', 'email' => 'u1@ma.il', 'password' => Hash::make('321654987'), 'created_at' => $now],
            ['name' => 'user2', 'email' => 'u2@ma.il', 'password' => Hash::make('321654987'), 'created_at' => $now],
            ['name' => 'user3', 'email' => 'u3@ma.il', 'password' => Hash::make('321654987'), 'created_at' => $now],
            ['name' => 'user4', 'email' => 'u4@ma.il', 'password' => Hash::make('321654987'), 'created_at' => $now],
            ['name' => 'user5', 'email' => 'u5@ma.il', 'password' => Hash::make('321654987'), 'created_at' => $now],
        ]);

        DB::table('task_statuses')->insert([
            ['name' => 'новый', 'created_at' => $now],
            ['name' => 'в работе', 'created_at' => $now],
            ['name' => 'на тестировании', 'created_at' => $now],
            ['name' => 'завершен', 'created_at' => $now],
        ]);

        Task::factory()->count(20)->create();
        Label::factory()->count(5)->create();
    }
}
