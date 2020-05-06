<?php

namespace App\Http\Controllers;

use App\ConversionValue;
use App\Currency;
use App\Http\Requests\WalletRequest;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WalletController extends Controller
{

    public function getWallets(Request $request)
    {

        $userData = Auth::user();
        $userData = $userData->where('id', $userData->id)->with(['wallets'])->first();

        foreach ($userData->wallets as $wallet)
        {
            $userWallets[] = [
                'name' => $wallet->currency->name,
                'description' => $wallet->currency->description,
                'image' => $wallet->currency->image,
                'conversion' => [ 'btc' => $wallet->currency->conversionValue->btc_value  , 'usd' => $wallet->currency->conversionValue->usd_value],
                'balance' => $wallet->balance
            ];
            $hasCurrencyWallet[] = $wallet->currency->id;
        }

        $fakeWallets = $userData->walletsThatDoNotHave($hasCurrencyWallet);

        $wallets = array_merge($userWallets,  $fakeWallets);

        return response()->json(['currencies' => $wallets]);
    }


    public function exchangeWallet(Request $request)
    {
        $request->validate([
            'walletFromCurrency' => 'required|exists:currencies,id',
            'walletToCurrency' => 'required|exists:currencies,id',
        ]);

        $userData = Auth::user();

        $valueToExchange = $request->valueToExchange;
        $userWallets = $this->getUserWallets($userData->id);
        $walletFromExchange = $userWallets->where('currency_id', $request->walletFromCurrency)->first();

        if ($walletFromExchange == null){
            return response()->json(['message' => 'Carteira inválida']);
        }

        if ($walletFromExchange->balance < $valueToExchange){
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
        $toWallet->update(['balance' => ($fromWallet->balance/$fromWallet->currency->conversionValue->usd_value)/$toWallet->currency->conversionValue->usd_value]);
        $fromWallet->currency->usd_value;
        $fromWallet->update(['balance' => 0]);
    }




}
