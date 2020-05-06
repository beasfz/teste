<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConversionValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conversion_values')->insert([
            ['currency_id' => 2, 'btc_value' => 0.024, 'usd_value' => 215.79],
            ['currency_id' => 1, 'btc_value' => 1, 'usd_value' => 9071.06],
            ['currency_id' => 3, 'btc_value' => 0.0055, 'usd_value' => 48.22],
            ['currency_id' => 4, 'btc_value' => 0.00015, 'usd_value' => 1],
        ]);
    }
}
