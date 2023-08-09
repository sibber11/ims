<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'type' => ['required', 'string', 'in:purchase,sale'],
            'tax' => ['required', 'numeric'],
            'shipping' => ['nullable', 'numeric'],
            'promo' => ['nullable','string'],
            'promo_discount' => ['required_with:promo', 'numeric'],
            'content' => ['nullable', 'string'],
            'items' => ['required', 'array'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
