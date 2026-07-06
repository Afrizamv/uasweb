<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'nama_mata_kuliah' => fake()->words(2, true),
            'kode_mata_kuliah' => strtoupper(fake()->bothify('??-###')),
            'dosen' => fake()->name(),
            'semester' => fake()->numberBetween(1, 8),
            'warna' => fake()->hexColor(),
        ];
    }
}
