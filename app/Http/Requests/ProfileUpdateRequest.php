<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'  => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo ":attribute" é obrigatório!',
            'max'      => 'O campo ":attribute" deve ter no máximo :max caracteres!',
            'unique'   => 'O campo ":attribute" já está sendo utilizado!',
            'email'    => 'O campo ":attribute" deve ser um e-mail válido!',
        ];
    }

    public function attributes(): array
    {
        return [
            'name'     => 'Nome',
            'email'    => 'E-mail',
            'password' => 'Senha',
            'role_id'  => 'Tipo de usuário',
        ];
    }
}
