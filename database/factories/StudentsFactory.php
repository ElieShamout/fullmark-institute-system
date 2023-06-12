<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Students>
 */
class StudentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'near' => '',
            'class' => $this->faker->randomElement([1,2,3,4,5,6,7,8,9,10,11,12]),
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
