<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    public function rules()
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'mobile' => ['required'],
            'email' => ['required', 'email', 'max:254'],
            'line_1' => ['required'],
            'line_2' => ['required'],
            'city' => ['required'],
            'province' => ['required'],
            'country' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
