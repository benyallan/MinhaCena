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
            'title' => $this->faker->sentence(),
            'student' => $this->faker->firstName(),
            'school_id' => School::factory()->create()->id,
            'teacher_id' => Teacher::factory()->create()->id,
            'composing' => $this->faker->paragraph()
        ];
    }
}
