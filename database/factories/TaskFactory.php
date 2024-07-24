<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TaskStatus;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statusIds = TaskStatus::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

        return [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence(6, true),
            'status_id' => $this->faker->randomElement($statusIds),
            'created_by_id' => $this->faker->randomElement($userIds),
            'assigned_to_id' => $this->faker->randomElement($userIds),
        ];
    }
}
