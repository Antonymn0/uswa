<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidateUswaCommisionAccount extends FormRequest
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
            'role' => 'string|required',
            'user_id' => 'integer|required|unique:uswa_commision_accounts',
            'last_amount_transacted' => 'required|integer',
            'last_transaction_type' => 'required|string',
            'fee_percentage' => 'required|integer',
            'available_balance' => 'required|integer',
            'balance_before' => 'required|integer',
            'balance_after' => 'required|integer',
        ];
    }
}
