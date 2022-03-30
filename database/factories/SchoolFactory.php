<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create(['user_type' => 'School'])->id,
            'name' => $this->faker->company(),
            'contactPerson' => $this->faker->name(),
            'type' => $this->faker->word(),
            'state' => $this->faker->state(),
            'city' => $this->faker->city(),
            'unlocked_at' => $this->faker->date('d_m_Y')
        ];
    }
}
