<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_completo' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'email', 'max:255', 'unique:clientes,correo'],
            'telefono' => ['nullable', 'string', 'max:50'],
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
            'correo.unique' => 'Ya existe un cliente con este correo.'
        ];
    }
}
