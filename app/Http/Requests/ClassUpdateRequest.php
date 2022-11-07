<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'max:50|required',
            'teacher_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'teacher_id' => 'teacher',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Wajib Diisi !',
            'name.max' => 'Nama Kelas Maksimal :max Karakater !',
            'teacher_id.required' => 'Nama Guru Wajib Diisi !',
        ];
    }
}
