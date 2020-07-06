<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name'                  => 'required',
            'email'                 => 'required|email|unique:users,email|regex:/(.+)@(.+)\.(.+)/i|bail',
            'username'              => 'required|unique:users,username',
            'password'              => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|bail',
            'password_confirmation' => 'required|same:password',
        ];
    }
}
