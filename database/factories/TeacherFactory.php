<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create(['user_type' => 'Teacher'])->id,
            'name' => $this->faker->name(),
            'cpf' => $this->faker->unique()->cpf(false),
            'birthday' => $this->faker->date('d_m_Y'),
            'state' => $this->faker->state(),
            'city' => $this->faker->city(),
            'unlocked_at' => $this->faker->date('d_m_Y')
        ];
    }
}
