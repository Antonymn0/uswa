<?php

namespace App\Http\Requests\Assignment;

use Illuminate\Foundation\Http\FormRequest;

class ValidateAssignmentRequest extends FormRequest
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
            'lesson_id' => ['required', 'integer'],
            'student_id' => ['required', 'integer'],
            'tutor_id' => ['required', 'integer'],
            'uploaded_by' => ['required', 'integer'],
            'lesson_type' => ['required', 'string'],
            'assignment_type' => ['nullable', 'string'],
            'file'=> ['required', 'mimetypes:application/pdf,application/doc,application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
            'assignment_score' => ['nullable', 'integer'],
            'description' => ['required', 'string']
        ];
    }
}
