<?php

namespace Database\Factories;

use App\Models\Illustrator;
use Illuminate\Database\Eloquent\Factories\Factory;

class SocialMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'urlAddress' => $this->faker->url(),
            'illustrator_id' => Illustrator::factory()
        ];
    }
}
