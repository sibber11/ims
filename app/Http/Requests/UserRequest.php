<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'username' => ['required', 'unique:users'],
            'mobile' => ['required'],
            'email' => ['required', 'email', 'max:254', 'unique:users'],
            'password' => ['required'],
            'intro' => ['nullable'],
            'profile' => ['nullable'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
