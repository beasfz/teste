<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
