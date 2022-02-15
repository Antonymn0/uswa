<?php

namespace App\Http\Requests\Triallesson;

use Illuminate\Foundation\Http\FormRequest;

class ValidateTrialLesson extends FormRequest
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
            'student_id' => ['required', 'integer'],
            'tutor_id' => ['required', 'integer'],
            'lesson_date' => ['required', 'date'],
            'start_time' => ['required', 'string'],
            'end_time' => ['required', 'string'],
            'student_timezone' => ['nullable', 'string'],
            'tutor_timezone' => ['nullable', 'string'],
        ];
    }
}
