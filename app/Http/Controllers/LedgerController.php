<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExchangeRequest;
use App\Http\Resources\ExchangeResource;
use App\Http\Resources\LedgerResource;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    /**
     * Get list of currencies and then balance
     * @param Request $request
     */
    public function ledger(Request $request)
    {
        $user = $request->user();
        
        return new LedgerResource([
            'coins' => $user->coins
        ]);
    }

    /**
     * Make a currency conversion
     * @param ExchangeRequest $request
     * @return ExchangeResource
     */
    public function exchange(ExchangeRequest $request)
    {
        return new ExchangeResource([
            'coin' => $request->coin->first()
        ]);
    }
    
}
