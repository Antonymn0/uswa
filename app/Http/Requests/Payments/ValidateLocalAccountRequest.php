<?php

namespace App\Http\Requests\Payments;

use Illuminate\Foundation\Http\FormRequest;

class ValidateLocalAccountRequest extends FormRequest
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
            'user_id' => ['required', 'integer'],
            'date_created' => ['required', 'date'],
            'balance_before' => ['required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'available_balance' => ['required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/']
        ];
    }
}
