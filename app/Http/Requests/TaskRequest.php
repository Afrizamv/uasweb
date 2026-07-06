<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Checked via Policy
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'subject_id' => ['required', 'exists:subjects,id'],
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'deadline' => ['required', 'date'],
            'prioritas' => ['required', Rule::in(['Low', 'Medium', 'High'])],
            'status' => ['required', Rule::in(['Belum Dimulai', 'Sedang Dikerjakan', 'Selesai', 'Terlambat'])],
            'lampiran' => [
                'nullable',
                'file',
                'max:10240', // 10MB in kilobytes
                'mimes:pdf,doc,docx,ppt,pptx,zip,rar'
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'subject_id.required' => 'Mata kuliah wajib dipilih.',
            'subject_id.exists' => 'Mata kuliah tidak valid.',
            'judul.required' => 'Judul tugas wajib diisi.',
            'deadline.required' => 'Deadline tugas wajib diisi.',
            'deadline.date' => 'Format deadline tidak valid.',
            'prioritas.required' => 'Prioritas tugas wajib dipilih.',
            'status.required' => 'Status tugas wajib dipilih.',
            'lampiran.max' => 'Ukuran file lampiran maksimal adalah 10 MB.',
            'lampiran.mimes' => 'Format file lampiran harus berupa PDF, DOCX, PPT, ZIP, atau RAR.',
        ];
    }
}
