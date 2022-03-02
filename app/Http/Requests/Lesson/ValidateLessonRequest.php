<?php

namespace App\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class ValidateLessonRequest extends FormRequest
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
            'student_id' => ['integer', 'required'],
            'tutor_id' => ['integer', 'required'],
            'trial_lesson_id' => ['integer', 'required',  'unique:lessons'],
            'lesson_total_duration' => ['string', 'nullable'],
            'lessons_start_date' => ['date', 'nullable'],
            'next_lesson_date' => ['date', 'nullable'],
            'previous_lesson_date' => ['date', 'nullable'],
            'covered_duration' => ['string', 'nullable'],
            'remaining_duration' => ['string', 'nullable'],
            'start_time' => ['string', 'nullable'],
            'end_time' => ['string', 'nullable'],
            'lesson_type' => ['string', 'nullable'],
            'tutor_confirm' => ['string', 'nullable'],
            'student_confirm' => ['string', 'nullable'],
            'tutor_timezone' => ['string', 'nullable'],
            'student_timezone' => ['string', 'nullable'],
            'decline_reason' => ['string', 'nullable'],
            'postponed' => ['string', 'nullable'],
            'postponed_to' => ['string', 'nullable'],
            'postponed_reason' => ['string', 'nullable'],
            'student_score' => ['string', 'nullable'],
            'student_remarks' => ['string', 'nullable'],
            'tutor_remarks' => ['string', 'nullable'],
            'status' => ['string', 'nullable'],
            'meeting_link' => ['string', 'nullable'],
        ];
    }
}
