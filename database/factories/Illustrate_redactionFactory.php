<?php

namespace Database\Factories;

use App\Models\Illustrator;
use App\Models\Redaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class illustrate_redactionFactory extends Factory
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
            'illustrator_id' => Illustrator::factory()->create()->id,
            'delivered_at' => $this->faker->date('d-m-Y'),
            'illustration' => $this->faker->url(),
        ];
    }
}
