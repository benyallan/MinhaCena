<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        db::table ('users')->insert([
            'user_type'=>'super',
            'email'=>'teste@example.com',
            'verified_at'=>now(),
            'password'=>'teste123',
            'lastAccess'=>now()
        ]);
        
        db::table ('administrators')->insert([
            'user_id'=>1,
            'name'=>'teste@example.com',
            'CPF'=>now(),
            'birthday'=>now(),
            'state'=>'SP',
            'city'=>'São Paulo'
        ])
        
    }
}
