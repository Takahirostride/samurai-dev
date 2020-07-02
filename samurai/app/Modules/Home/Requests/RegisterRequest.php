<?php

namespace App\Modules\Home\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'e_mail'        => 'required|unique:users',
            'password'      => 'required|min:8',
            'username'      => 'required|unique:users',
            // 'displayname'   => 'required',
            'manage_flag'   => 'required',
            'agrement'      => 'required',
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'e_mail.required'       => '必須',
            'e_mail.unique'         => 'このメールアドレスは既に使われています',
            'password.required'     => '必須',
            'username.required'     => '必須',
            'username.unique'       => 'このユーザー名は既に使われています',
            // 'displayname.required'  => '必須',
            'manage_flag.required'  => '必須',
            'agrement.required'     => '必須',
        ];
    }
}
