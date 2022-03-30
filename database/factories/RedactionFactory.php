<?php

namespace Database\Factories;

use App\Models\School;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class RedactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentences(),
            'student' => $this->faker->firstName(),
            'school_id' => School::factory(),
            'teacher_id' => Teacher::factory(),
            'composing' => $this->faker->paragraphs()
        ];
    }
}
