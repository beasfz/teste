<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExchangeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $coin = $this['coin'];
        $balance = $coin->pivot->balance;

        return [
            'btc' => $coin->conversion->btc * $balance,
            'usd' => $coin->conversion->usd * $balance
        ];
    }
}
