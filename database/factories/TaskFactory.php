<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
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
        return [
            'subject_id' => Subject::factory(),
            'judul' => fake()->sentence(4),
            'deskripsi' => fake()->paragraph(),
            'deadline' => fake()->dateTimeBetween('-1 week', '+3 weeks'),
            'prioritas' => fake()->randomElement(['Low', 'Medium', 'High']),
            'status' => fake()->randomElement(['Belum Dimulai', 'Sedang Dikerjakan', 'Selesai', 'Terlambat']),
            'lampiran' => null,
        ];
    }
}
