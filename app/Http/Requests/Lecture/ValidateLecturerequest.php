<?php

namespace App\Http\Requests\Lecture;

use Illuminate\Foundation\Http\FormRequest;

class ValidateLecturerequest extends FormRequest
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
            'tutor_id' => 'required|integer',
            'lecture_name' => 'required|string',
            'lecture_duration' => 'required|string',
            'lecture_description' => 'required|string',
        ];
    }
}
