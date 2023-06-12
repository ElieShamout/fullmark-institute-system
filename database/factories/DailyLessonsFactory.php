<?php

namespace Database\Factories;

use App\Models\Lessons;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DailyLessons>
 */
class DailyLessonsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'lesson_id'  => $this->faker->randomElement(Lessons::get()->id),
            // 'state' => $this->faker->randomElement()
        ];
    }
}
