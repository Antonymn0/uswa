<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTutorScheduleRequest extends FormRequest
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
            'monday' => ['required', 'string'],
            'tuesday' => ['required', 'string'],
            'wednesday' => ['required', 'string'],
            'thursady' => ['required', 'string'],
            'friday' => ['required', 'string'],
            'saturday' => ['required', 'string'],
            'sunday' => ['required', 'string'],
        ];
    }
}
