<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DataPasienRequest extends FormRequest
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
        'nomor_induk' =>'required|max:225',
        'name' =>'required|max:225',
        'username' =>'required|max:225',
        'email' =>'required|max:225',
        'password' =>'required|max:225',
        'profesi' =>'required|max:225',
        'roles' =>'required|max:225'
        ];
    }
}
