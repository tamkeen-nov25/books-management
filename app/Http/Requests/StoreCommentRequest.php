<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'min:3', 'max:1000'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'commentable_type' => ['required', 'in:book,category'],
            'commentable_id' => ['required', 'integer'],
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator(Validator $validator): Validator
    {
        $validator->after(function ($validator) {
            $commentableType = $this->input('commentable_type');
            $commentableId = $this->input('commentable_id');

            if ($commentableType === 'book') {
                if (! \App\Models\Book::where('id', $commentableId)->exists()) {
                    $validator->errors()->add('commentable_id', 'The selected book does not exist.');
                }
            } elseif ($commentableType === 'category') {
                if (! \App\Models\Category::where('id', $commentableId)->exists()) {
                    $validator->errors()->add('commentable_id', 'The selected category does not exist.');
                }
            }
        });

        return $validator;
    }
}
