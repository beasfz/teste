<?php

namespace App\Http\Controllers;

use App\Currency;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
//    public function getWallets($user)
//    {
//        {
//            $currencies =  Currency::get();
//            $user = User::where('id', $user)->with('wallets')->first();
//
//            foreach ($user->wallets as $wallet)
//            {
//                $currency = $currencies->find($wallet->id);
//                $wallets[] = [
//                    'name' => $currency->name,
//                    'description' => $currency->description,
//                    'image' => $currency->image,
//                    'conversion' => [ 'btc' =>$currency->btc_value, 'usd' => $currency->usd_value],
//                    'balance' => $wallet->balance
//                ];
//            }
//            return response()->json(['currencies' => $wallets]);
//        }
//    }
}
