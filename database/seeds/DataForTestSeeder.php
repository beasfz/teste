<?php

use App\Coin;
use App\User;
use Illuminate\Database\Seeder;

class DataForTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::updateOrCreate(
            [
                'email' => 'airesjoao25@gmail.com'
            ],
            [
                'name' => 'Joao Aires',
                'email' => 'airesjoao25@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('qweqwe'),
                'remember_token' => Str::random(10),
            ]
        );

        $btc = Coin::whereName('BTC')->first();
        $eth = Coin::whereName('ETH')->first();

        $user->coins()->sync([
            $btc->id => ['balance' => 0], 
            $eth->id => ['balance' => 4.25], 
        ]);
    }
}
