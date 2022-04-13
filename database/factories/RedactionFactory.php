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
        $teacher = Teacher::factory()->create()->id;
        return [
            'title' => $this->faker->sentence(),
            'student' => $this->faker->firstName(),
            'school_id' => $teacher->school->id,
            'teacher_id' => $teacher->id,
            'composing' => $this->faker->paragraph()
        ];
    }
}
