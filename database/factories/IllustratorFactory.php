<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class IllustratorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'cpf' => $this->faker->unique()->cpf(false),
            'birthday' => $this->faker->date('d-m-Y'),
            'state' => $this->faker->state(),
            'city' => $this->faker->city(),
            'portfolio' => $this->faker->url(),
            'socialMedias' => $this->faker->url(),
            'unlocked_at' => $this->faker->date('d-m-Y')
        ];
    }
}
