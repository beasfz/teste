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
            ['name' => 'BTC', 'description' => 'Bitcoin', 'image' => 'http://altcoinlab.netxs.com.br/test/icons/bitcoin.png', 'btc_value' => '1', 'usd_value' => '7233.20'],
            ['name' => 'ETH', 'description' => 'Ethereum', 'image' => 'http://altcoinlab.netxs.com.br/test/icons/ethereum.png', 'btc_value' => '0.026', 'usd_value' => '184.60'],
            ['name' => 'LTC', 'description' => 'Litecoin', 'image' => 'http://altcoinlab.netxs.com.br/test/icons/litecoin.png', 'btc_value' => '0.0059', 'usd_value' => '40.81'],
            ['name' => 'USDT', 'description' => 'Tether', 'image' => 'http://altcoinlab.netxs.com.br/test/icons/litecoin.png', 'btc_value' => '0.00014111', 'usd_value' => '1.01']
        ]);
    }
}
