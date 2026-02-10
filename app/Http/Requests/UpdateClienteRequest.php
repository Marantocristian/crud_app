<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $clienteId = $this->route('cliente')->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', "unique:clientes,email,{$clienteId}"],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255']
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombre',
            'email' => 'email',
            'phone' => 'telefono',
            'address' => 'direccion'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email no es valido.',
            'email.unique' => 'Ya existe otro cliente con este email.'
        ];
    }
}
