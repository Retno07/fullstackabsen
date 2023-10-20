<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MakulRequest extends FormRequest
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
        'id_mata_kuliah' =>'required|max:225',
        'id_prodi' =>'required|max:225',
        'nama_mata_kuliah' =>'required|max:225',
        'sks_mata_kuliah' =>'required|max:225',
        'semester_mata_kuliah' =>'required|max:225' 
        ];
    }
}
