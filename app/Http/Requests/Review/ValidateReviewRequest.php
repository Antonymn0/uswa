<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class ValidateReviewRequest extends FormRequest
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
            'reviewer_id' => ['required', 'integer'],
            'reviewee_id' => ['required', 'integer'],
            'body' => ['required', 'string'],
            'stars' => ['required', 'integer']
        ];
    }
}
