<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AbsenRequest extends FormRequest
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
        'nim_mahasiswa_absen' =>'required|max:225',
        'id_log_absen' =>'required|max:225',
        'keterangan_log_absen' =>'required|max:225',
        'pertemuan_log_absen' =>'required|max:225',
        ];
    }
}
