<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LogBookRequest extends FormRequest
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
        'id_kelas_identity' =>'required|max:225',
        'id_prodi_identity' =>'required|max:225',
        'jml_mhs' =>'required|max:225',
        'id_makul_identity' =>'required|max:225',
        'id_dosen_identity' =>'required|max:225',
        'id_akademik_identity' =>'required|max:225' 
        ];
    }
}
