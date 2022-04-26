<?php

namespace Database\Factories;

use App\Models\Illustrator;
use Illuminate\Database\Eloquent\Factories\Factory;

class RedactionTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'redaction_id' => $this->faker->numberBetween(1, 5),
            'tag_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
