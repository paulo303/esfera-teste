<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneNumberRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user_id' => ['required', 'integer'],
            'numero'  => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
