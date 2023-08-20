<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
//            'total_amount' => ['required', 'integer'],
//            'sub_total' => ['required', 'integer'],
            'payment_method' => ['required'],
//            'payment_status' => ['required', 'integer'],
            'change_given' => ['nullable', 'integer'],
            'notes' => ['nullable', 'string'],
            'items' => ['required', 'array'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
