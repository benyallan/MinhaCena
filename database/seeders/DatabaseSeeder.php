<?php

namespace Database\Seeders;

use App\Models\Redaction as ModelsRedaction;
/* use App\Models\Teacher as ModelsTeacher; */
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\SocialMedia::factory(5)->create();
        \App\Models\Tag::factory(5)->create();
        \App\Models\Log::factory(5)->create();
        foreach (ModelsRedaction::all() as $redaction) {
            $redaction->tags()->attach(rand(1,3));
            $redaction->tags()->attach(rand(4,5));
            $redaction->illustrators()->attach(rand(1,3));
            $redaction->illustrators()->attach(rand(4,5));
        }
        /*
        foreach (ModelsTeacher::all() as $teacher) {
            $teacher->schools()->attach(rand(1,3));
            $teacher->schools()->attach(rand(4,5));
        }*/
    }
}
