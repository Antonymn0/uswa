<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ValidateUser extends FormRequest
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
            'full_name' => ['required'], 
            'email' => ['required', 'string', 'unique:users'],
            'role' => ['required', 'string'],
            'password' => ['required', 'string','min:4'],
            'local_timezone' => ['nullable', 'string'],
           
        ];
    }
}
