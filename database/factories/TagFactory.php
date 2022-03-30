<?php

namespace Database\Factories;

use App\Models\Administrator;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'tag' => $this->faker->word(),
            'administrator_id' => Administrator::factory()->create()->id
        ];
    }
}
