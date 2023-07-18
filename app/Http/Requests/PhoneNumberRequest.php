<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneNumberRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer'],
            'numero'  => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
