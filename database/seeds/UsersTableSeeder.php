<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
//            ['name' => Str::random(10), 'email' => Str::random(10).'@gmail.com', 'password' =>  Hash::make('password')]
            ['name' => 'Lucas Aguiar', 'email' => 'lucas@gmail.com', 'password' =>  Hash::make('teste@123')]
        ]);
    }
}
