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
            'name' => $this->faker->company(),
            'contactPerson' => $this->faker->name(),
            'type' => $this->faker->word(),
            'street' => $this->faker->streetName(),
            'number' => $this->faker->randomNumber(),
            'state' => $this->faker->state(),
            'city' => $this->faker->city(),
            'unlocked_at' => $this->faker->date('d/m/Y')
        ];
    }
}
