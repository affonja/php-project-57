<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaskStatus;

class TaskStatusSeeder extends Seeder
{
    public function run()
    {
        TaskStatus::factory()->count(10)->create();
    }
}
