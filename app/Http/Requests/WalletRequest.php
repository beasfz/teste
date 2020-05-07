<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WalletRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'walletFromCurrency' => 'required|exists:currencies,id',
            'walletToCurrency' => 'required|exists:currencies,id',
            'valueToExchange' => 'required|not_in:0'
        ];
    }
}
