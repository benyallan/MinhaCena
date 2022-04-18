<?php

namespace Database\Seeders;

use App\Models\Illustrator;
use Illuminate\Database\Seeder;

class IllustratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Illustrator::factory()->count(5)->create();
    }
}
