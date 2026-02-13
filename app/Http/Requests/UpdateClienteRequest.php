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
            'nombre_completo' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'email', 'max:255', "unique:clientes,correo,{$clienteId}"],
            'telefono' => ['nullable', 'string', 'max:50', "unique:clientes,telefono,{$clienteId}"],
            'direccion' => ['nullable', 'string', 'max:255']
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre_completo' => 'nombre completo',
            'correo' => 'correo',
            'telefono' => 'telefono',
            'direccion' => 'direccion'
        ];
    }

    public function messages(): array
    {
        return [
            'nombre_completo.required' => 'El nombre completo es obligatorio.',
            'correo.required' => 'El correo es obligatorio.',
            'correo.email' => 'El correo no es valido.',
            'correo.unique' => 'Ya existe otro cliente con este correo.',
            'telefono.unique' => 'Ya existe otro cliente con este telefono.'
        ];
    }
}
