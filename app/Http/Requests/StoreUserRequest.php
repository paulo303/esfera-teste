<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class StoreUserRequest extends FormRequest
{
    /**
     * @return array<string,array<int,string|null>>
     */
    public function rules(): array
    {
        return [
            'name'     => ['required', 'max:255'],
            'email'    => ['required', 'string', 'email:filter', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id'  => ['required', 'integer'],
        ];
    }

    /**
     * @return array<string>
     */
    public function messages(): array
    {
        return [
            'required'  => 'O campo ":attribute" é obrigatório!',
            'max'       => 'O campo ":attribute" deve ter no máximo :max caracteres!',
            'unique'    => 'O campo ":attribute" já está sendo utilizado!',
            'email'     => 'O campo ":attribute" deve ser um e-mail válido!',
            'confirmed' => 'As senhas não coincidem!',
            'min'       => 'O campo ":attribute" deve ter no mínimo :min caracteres!',
        ];
    }

    /**
     * @return array<string>
     */
    public function attributes(): array
    {
        return [
            'name'     => 'Nome',
            'email'    => 'E-mail',
            'password' => 'Senha',
            'role_id'  => 'Tipo de usuário',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
