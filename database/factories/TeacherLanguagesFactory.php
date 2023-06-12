<?php

namespace Database\Factories;

use App\Models\Languages;
use App\Models\Teachers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeacherLanguages>
 */
class TeacherLanguagesFactory extends Factory
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
            'language_id' => $this->faker->randomElement(Languages::get())->id,
        ];
    }
}
