<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|in:active,completed,archived',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama project wajib diisi.',
            'name.max' => 'Nama project maksimal 255 karakter.',
            'status.in' => 'Status project tidak valid.',
        ];
    }
}