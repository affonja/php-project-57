<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Label;

class LabelSeeder extends Seeder
{
    public function run()
    {
        Label::factory()->count(10)->create();
    }
}
