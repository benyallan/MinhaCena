<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdministratorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create(['user_type' => 'Administrator'])->id,
            'name' => $this->faker->name(),
            'cpf' => $this->faker->unique()->cpf(false),
            'birthday' => $this->faker->date(),
            'state' => $this->faker->state(),
            'city' => $this->faker->city()
        ];
    }
}
