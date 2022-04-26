<?php

namespace Database\Seeders;

use App\Http\Resources\Redaction;
use App\Models\Redaction as ModelsRedaction;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
        *\App\Models\Tag::factory(5)->create();
        *\App\Models\User::factory(1)->create();
        *\App\Models\Redaction::factory(5)->create();
        */

        // \App\Models\Illustrate_redaction::factory(5)->create();
        \App\Models\SocialMedia::factory(5)->create();
        \App\Models\Tag::factory(5)->create();
        \App\Models\Log::factory(5)->create();
        foreach (ModelsRedaction::all() as $redaction) {
            $redaction->tags()->attach(Tag::first());
        }
    }
}
