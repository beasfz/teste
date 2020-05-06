<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wallets')->insert([
            ['user_id' => 1, 'currency_id' => 1, 'balance' => 2.34719899],
            ['user_id' => 1, 'currency_id' => 2, 'balance' => 2.13]
        ]);
    }
}
