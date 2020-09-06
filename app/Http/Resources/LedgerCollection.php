<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LedgerCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'conversion' => [
                'btc' => $this->conversion->btc,
                'usd' => $this->conversion->usd
            ],
            'balance' => $this->pivot->balance
        ];
    }
}
