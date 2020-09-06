<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ExchangeRequest extends FormRequest
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
            'coin' => 'required'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $user = $this->user();
        $coins = $user->coins;

        $coinToExchange = $coins->filter(function ($value, $key) {
            return (
                $value->pivot->balance > 0 &&
                $value->name == strtoupper($this->name)
            );
        });

        $this->merge([
            'coin' => $coinToExchange
        ]);
    }

    /**
     * Return error if validation fail
     *
     * @return Json
     */     
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
        response()->json(
            [
                'errors' => $validator->errors()->all()
            ], 400
        ));
    }
}
