<?php

namespace Database\Factories;

use App\Models\Subjects;
use App\Models\Teachers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeacherSubjects>
 */
class TeacherSubjectsFactory extends Factory
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
            'subject_id' => $this->faker->randomElement(Subjects::get())->id,
        ];
    }
}
