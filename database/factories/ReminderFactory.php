<?php

namespace Database\Factories;

use App\Models\Reminder;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reminder>
 */
class ReminderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task_id' => Task::factory(),
            'reminder_date' => fake()->dateTimeBetween('-1 week', '+2 weeks'),
            'status' => fake()->randomElement(['Pending', 'Completed']),
        ];
    }
}
