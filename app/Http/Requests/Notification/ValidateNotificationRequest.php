<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;

class ValidateNotificationRequest extends FormRequest
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
            'sender' => ['string', 'required'],
            'recipient' => ['string', 'required'],
            'title' => ['string', 'required'],
            'body' => ['string', 'required'],
            'status' => ['string', 'required']
        ];
    }
}
