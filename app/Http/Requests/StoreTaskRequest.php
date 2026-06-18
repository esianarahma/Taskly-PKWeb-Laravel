<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'project_id' => 'required|integer|exists:projects,id',
            'category_id' => 'nullable|integer|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'status' => 'required|in:todo,in_progress,done',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date|after_or_equal:today',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'project_id.required' => 'Project wajib dipilih.',
            'project_id.exists' => 'Project yang dipilih tidak valid.',
            'title.required' => 'Judul task wajib diisi.',
            'title.max' => 'Judul task maksimal 255 karakter.',
            'status.in' => 'Status tidak valid.',
            'priority.in' => 'Prioritas tidak valid.',
            'due_date.after_or_equal' => 'Deadline tidak boleh tanggal yang sudah lewat.',
            'attachment.mimes' => 'Lampiran harus berformat PDF, JPG, JPEG, atau PNG.',
            'attachment.max' => 'Ukuran lampiran maksimal 2MB.',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            if ($this->hasFile('attachment')) {
                $file = $this->file('attachment');
                $allowedMimes = ['application/pdf', 'image/jpeg', 'image/png'];

                if (!in_array($file->getMimeType(), $allowedMimes)) {
                    $validator->errors()->add('attachment', 'Tipe file tidak valid atau file rusak.');
                }
            }
        });
    }
}