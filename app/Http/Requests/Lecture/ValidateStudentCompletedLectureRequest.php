<?php

namespace App\Http\Requests\Lecture;

use Illuminate\Foundation\Http\FormRequest;

class ValidateStudentCompletedLectureRequest extends FormRequest
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
            'student_id' => 'required|integer',
            'lecture_id' => 'required|integer',
            'marked_by' => 'required|integer',
            'lesson_id' => 'required|integer',
            'payment_status' => 'required|string',
            'payment_date' => 'nullable|string',
            'paid_amount' => 'nullable|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
            'amount_due' => 'nullable|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
            'payment_reciept_no' => 'nullable|string',
        ];
    }
}
