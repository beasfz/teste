<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    public function conversionValue()
    {
        return $this->hasOne(ConversionValue::class);
    }
}
