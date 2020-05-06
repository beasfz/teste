<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('user/auth', 'AuthController@authenticate')->name('login');

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('user/wallets', 'WalletController@getWallets');
    Route::post('user/exchange', 'WalletController@exchangeWallet');
});
