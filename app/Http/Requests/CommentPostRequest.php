<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CommentPostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'content' => 'required|max:255',
            'authorName' => 'required|max:150',
            'newsId' => 'required|integer'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator);
    }
}
