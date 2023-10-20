<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LogAbsenRequest extends FormRequest
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
        'id_identity_log' =>'required|max:225',
        'pertemuan_log' =>'required|max:225',
        'hari_log' =>'required|max:225',
        'waktu_mulai_log' =>'required|max:225',
        'waktu_selesai_log' =>'required|max:225',
        'id_ruang_log' =>'required|max:225',
        'materi_log' =>'required|max:225',
        'metode_pbm_log' =>'required|max:225',
        'jumlah_mhs_hadir_log' =>'required|max:225',
        'qr_code_log' =>'required|image',
        'log_is_verif' =>'required|max:225',
        ];
    }
}
