<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'type' => ['required', 'integer'],
            'status' => ['required', 'integer'],
            'sub_total' => ['required', 'numeric'],
            'item_discount' => ['required', 'numeric'],
            'tax' => ['required', 'numeric'],
            'shipping' => ['nullable', 'numeric'],
            'total' => ['required', 'numeric'],
            'promo' => ['nullable'],
            'promo_discount' => ['nullable', 'numeric'],
            'grand_total' => ['required', 'numeric'],
            'content' => ['nullable'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
