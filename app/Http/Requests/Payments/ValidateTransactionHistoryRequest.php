<?php

namespace App\Http\Requests\Payments;

use Illuminate\Foundation\Http\FormRequest;

class ValidateTransactionHistoryRequest extends FormRequest
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
            'transaction_id' => ['required', 'string', 'unique:transaction_histories'],
            'transaction_type' => ['required', 'string'],
            'payment_method' => ['required', 'string'],
            'amount_transacted' => ['required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'transacted_from' => ['required', 'string'],
            'transacted_to' => ['required', 'string'],
            'commision_charged' => ['required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'balance_before' => ['required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'balance_after' => ['required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'transaction_date' => ['required', 'date'],
            'remarks' => ['required', 'string'],
        ];
    }
}
