<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUser extends FormRequest
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
            'first_name' => ['required'],
            'middle_name' => ['nullable'],
            'last_name' => ['required'],
            'username' => ['nullable', 'string', Rule::unique('users')->ignore($this->user)],
            'email'=>['required', 'string','max:255','email',  Rule::unique('users')->ignore($this->user)],
            'role' => ['required'],
            'phone' => ['nullable'],
            'address' => ['nullable'],
            'biography' => ['nullable'],
            'biography' => ['nullable'],
            'id_number' => ['nullable'],
            'date_of_birth' => ['nullable'],
            'city' => ['nullable'],
            'country' => ['nullable'],
            'nationality' => ['nullable'],
            'postal_code' => ['nullable'],
            'phone_verified_at' => ['nullable'],
            'email_verified_at' => ['nullable'],
            'id_verified_at' => ['nullable'],
            'suspended_at' => ['nullable'],
            'approved' => ['nullable'],
            'approved_at' => ['nullable'],
            'deleted_at' => ['nullable'],
            'approved_by' => ['nullable'],
            'registered_by' => ['nullable'],
            'suspended_by' => ['nullable'],
            'reason_suspended' => ['nullable'],
            'image' => ['nullable']
        ];
    }
}
