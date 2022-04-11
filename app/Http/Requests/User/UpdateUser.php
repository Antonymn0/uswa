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
            'first_name' => ['nullable', 'string'],
            'middle_name' => ['nullable', 'string'],
            'last_name' => ['nullable', 'string'],
            'username' => ['nullable', 'string', 'string', Rule::unique('users')->ignore($this->user)],
            'phone' => ['nullable', 'string', Rule::unique('users')->ignore($this->user)],
            'address' => ['nullable', 'string'],
            'biography' => ['nullable', 'string'],
            'biography' => ['nullable', 'string'],

            'id_number' => ['nullable', 'string', Rule::unique('users')->ignore($this->user)],
            'date_of_birth' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'country' => ['nullable', 'string'],
            'country_code' => ['nullable', 'string'],
            'nationality' => ['nullable', 'string'],
            'postal_code' => ['nullable', 'string'],

            'phone_verified_at' => ['nullable', 'string'],
            'email_verified_at' => ['nullable', 'string'],
            'suspended_at' => ['nullable', 'string'],
            'approved' => ['nullable', 'string'],
            'approved_at' => ['nullable', 'string'],
            'deleted_at' => ['nullable', 'string'],
            'approved_by' => ['nullable', 'string'],

            'registered_by' => ['nullable', 'integer'],
            'registration' => ['nullable', 'string'],
            'suspended_by' => ['nullable', 'string'],
            'reason_suspended' => ['nullable', 'string'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png,svg'],

            'timezone' => ['nullable', 'string'],
            'local_timezone' => ['nullable', 'string'],
            'currency' => ['nullable', 'string'],
            'language' => [ 'nullable', 'string'],
            'level' => ['nullable', 'string'],
            'subject' => [ 'nullable', 'string'],
            'subject_level' => [ 'nullable', 'string'],
            'over18' => [ 'nullable', 'string'],
            'description' => [ 'nullable', 'string'],

            'has_teaching_certificate' => ['string', 'nullable'],
            'teaching_certificate' => ['string', 'nullable'],
            'teaching_certificate_upload' => ['mimes:svg,png,jpg,jpeg', 'nullable'],
            'teaching_certificate_subject' => ['string', 'nullable'],
            'teaching_certificate_year_of_study_from' => ['string', 'nullable'],
            'teaching_certificate_year_of_study_to' => ['string', 'nullable'],
            'teaching_certificate_description' => ['string', 'nullable'],
            'teaching_certificate_issued_by' => ['string', 'nullable'],

            'higher_education_institution' => ['string', 'nullable'],
            'higher_education_level' => ['string', 'nullable'],
            'higher_education_type' => ['string', 'nullable'],
            'higher_education_study_from' => ['date', 'nullable'],
            'higher_education_study_to' => ['date', 'nullable'],
            'higher_education_specialty' => ['string', 'nullable'],
            'higher_education_certificate_upload' => ['mimes:jpg,jpeg,png,svg', 'nullable'],
            'has_higher_education_certificate' => ['string', 'nullable'],

            'hourly_rate' => [ 'nullable','regex:/^[0-9]+(\.[0-9]{1,2})?$/'],

            'introduction_video' => [ 'nullable','mimes:mp4'],
            'introduction_video_url' => ['string', 'nullable'],
            'schedule' => ['string', 'nullable'],
        ];
    }
}
