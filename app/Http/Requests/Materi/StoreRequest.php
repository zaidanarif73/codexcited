<?php

namespace App\Http\Requests\Materi;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => [
                'required',
            ],
            'description'=> [
                'required',
                ''
                ],
            'cover' => [
                'required',
                'image',
                'max:2048',
                'mimes:jpeg,bmp,png,gif,svg,jpg',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul harus diisi',
            'description.required' => 'Deksripsi harus diisi',
            'cover.required' => 'File harus diisi',
            'cover.image' => 'Foto harus berupa gambar',
            'cover.mimes' => 'Foto harus berupa jpeg, bmp, png, gif, svg , jpg',
            'cover.max' => 'Foto tidak boleh lebih dari 2MB',
        ];
    }
}
