<?php

namespace Database\Factories;

use App\Models\Levels;
use App\Models\Teachers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeacherLevels>
 */
class TeacherLevelsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'teacher_id' => $this->faker->randomElement(Teachers::get())->id,
            'level_id' => $this->faker->randomElement(Levels::get())->id,
        ];
    }
}
