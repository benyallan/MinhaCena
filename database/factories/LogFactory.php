<?php

namespace Database\Factories;

use App\Models\Redaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class LogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'redaction_id' => Redaction::factory()->create()->id,
            'where' => $this->faker->city(),
            'who' => $this->faker->name(),
        ];
    }
}
