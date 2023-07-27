<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'username' => ['required', 'unique:'.User::class],
            'mobile' => ['required', 'unique:'.User::class],
            'email' => ['required', 'email', 'max:254', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'intro' => ['nullable'],
            'profile' => ['nullable'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
