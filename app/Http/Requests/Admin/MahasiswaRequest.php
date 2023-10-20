<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MahasiswaRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'nim_mahasiswa' => 'required|max:225',
            'nama_mahasiswa' => 'required|max:225',
            'id_dosen' => 'required|max:255',
            'email_mahasiswa' => 'required|max:225',
            'password_mahasiswa' => 'required|max:225',
        ];
    }
}
