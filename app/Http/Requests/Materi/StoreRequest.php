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
                'max:100',
                'not_regex:/[\/]/' 
            ],
            'description'=> [
                'required',
                'max:200'
                ],
            'cover' => [
                'image',
                'max:2048',
                'mimes:jpeg,bmp,png,gif,svg,jpg',
            ],
            'type' => [
                'required',
            ],
            'difficulty' => [
                'required',
            ],
            
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul harus diisi',
            'title.max' => 'Judul tidak boleh lebih dari 100 karakter',
            'title.not_regex' => 'Judul tidak boleh mengandung karakter /',
            'description.required' => 'Deksripsi harus diisi',
            'description.max' => 'Deksripsi tidak boleh lebih dari 200 karakter',
            'cover.required' => 'File harus diisi',
            'cover.image' => 'Foto harus berupa gambar',
            'cover.mimes' => 'Foto harus berupa jpeg, bmp, png, gif, svg , jpg',
            'cover.max' => 'Foto tidak boleh lebih dari 2MB',
            'type.required' => 'Tipe materi harus diisi',
            'difficulty.required' => 'Tingkat kesulitan harus diisi',
        ];
    }
}
