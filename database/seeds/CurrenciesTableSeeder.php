<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            ['name' => 'BTC', 'description' => 'Bitcoin', 'image' => 'http://altcoinlab.netxs.com.br/test/icons/bitcoin.png'],
            ['name' => 'ETH', 'description' => 'Ethereum', 'image' => 'http://altcoinlab.netxs.com.br/test/icons/ethereum.png'],
            ['name' => 'LTC', 'description' => 'Litecoin', 'image' => 'http://altcoinlab.netxs.com.br/test/icons/litecoin.png'],
            ['name' => 'USDT', 'description' => 'Tether', 'image' => 'http://altcoinlab.netxs.com.br/test/icons/litecoin.png']
        ]);
    }
}
