<?php

namespace App\Http\Controllers;

use App\Currency;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{

    public function getWallets(Request $request)
    {       $userData = Auth::user();
        $currencies =  Currency::get();
        $user = User::where('id', $userData->id)->with('wallets')->first();

        foreach ($user->wallets as $wallet)
        {
            $wallets[] = [
                'name' => $wallet->currency->name,
                'description' => $wallet->currency->description,
                'image' => $wallet->currency->image,
                'conversion' => [ 'btc' =>$wallet->currency->btc_value, 'usd' => $wallet->currency->usd_value],
                'balance' => $wallet->balance
            ];
        }
        return response()->json(['currencies' => $wallets]);
    }

    public function exchangeWallet(Request $request)
    {
        $userData = Auth::user();

        $userWallets = $this->getUserWallets($userData->id);

        $walletFromExchange = $userWallets->where('currency_id', $request->walletFromCurrency)->first();

        if ($walletFromExchange == null || $walletFromExchange->balance == 0){
            return response()->json(['message' => 'Carteira não possui saldo']);
        }

        $hasWallet = $userWallets->contains('currency_id', $request->walletToCurrency);

        if (!$hasWallet) {
            $newWallet = Wallet::create([
                'user_id' => $userData->id,
                'currency_id' => $request->walletToCurrency,
                'balance' => 0
            ]);
            $userWallets->push($newWallet);
        }

        $walletToExchange = $userWallets->where('currency_id', $request->walletToCurrency)->first();

        $this->exchange($walletFromExchange, $walletToExchange);

        return $this->getWallets($request);
    }

    public function getUserWallets($userId)
    {
        return $userWallets = Wallet::where('user_id', $userId)->get();
    }

    private function exchange($fromWallet, $toWallet)
    {
        $toWallet->update(['balance' => ($fromWallet->balance*$fromWallet->currency->usd_value)/$toWallet->currency->usd_value]);
        $fromWallet->update(['balance' => 0]);
    }


    public function exchangeDetails($fromWallet, $toWallet)
    {
        //
    }


}
