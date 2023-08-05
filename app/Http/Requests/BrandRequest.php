<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255', 'unique:'.\App\Models\Brand::class],
            'summary' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
