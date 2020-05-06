<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    public function walletsThatDoNotHave($currencyIds)
    {
        $currencies = Currency::all();
        $walletsThatUserNoHas = $currencies->whereNotIn('id', $currencyIds);

        foreach ($walletsThatUserNoHas as $currency)
        {
            $fakeWallets[] = [
                'name' => $currency->name,
                'description' => $currency->description,
                'image' => $currency->image,
                'conversion' => [ 'btc' => $currency->conversionValue->btc_value  , 'usd' => $currency->conversionValue->usd_value],
                'balance' => 0
            ];
        }
        return $fakeWallets;
    }

}
