<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'array'],
            'title.en' => ['required', 'string', 'min:3', 'max:255'],
            'title.ar' => ['required', 'string', 'min:3', 'max:255'],

            'description' => ['nullable', 'array'],
            'description.en' => ['nullable', 'string'],
            'description.ar' => ['nullable', 'string'],

            'author' => ['required', 'string', 'min:3', 'max:255'],
            'published_year' => ['required', 'integer', 'min:1000', 'max:2025'],
            'is_available' => ['required', 'boolean'],
            'file' => ['nullable', 'file', 'mimes:pdf,epub,zip', 'max:20480'],
        ];
    }
}
