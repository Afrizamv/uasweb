<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // We will check actual ownership using Policies in controller
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nama_mata_kuliah' => ['required', 'string', 'max:255'],
            'kode_mata_kuliah' => ['required', 'string', 'max:100'],
            'dosen' => ['required', 'string', 'max:255'],
            'semester' => ['required', 'integer', 'min:1', 'max:20'],
            'warna' => ['required', 'string', 'max:7'], // Hex code like #ffffff
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nama_mata_kuliah.required' => 'Nama mata kuliah wajib diisi.',
            'kode_mata_kuliah.required' => 'Kode mata kuliah wajib diisi.',
            'dosen.required' => 'Nama dosen wajib diisi.',
            'semester.required' => 'Semester wajib diisi.',
            'semester.integer' => 'Semester harus berupa angka.',
            'warna.required' => 'Warna penanda wajib dipilih.',
        ];
    }
}
