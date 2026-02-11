@extends('layouts.app')

@section('title', 'Crear Cliente')

@section('content')
<style>
    .cliente-create-shell {
        background: linear-gradient(135deg, #071226 0%, #0a1730 100%);
        border-radius: 12px;
        padding: 2rem;
        color: #f8fafc;
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25);
    }

    .cliente-create-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1.75rem;
    }

    .cliente-create-shell .form-label {
        color: #f8fafc;
        font-weight: 600;
        margin-bottom: 0.55rem;
    }

    .cliente-dark-input {
        background-color: #ffffff;
        border: 1px solid #cbd5e1;
        color: #0f172a;
        border-radius: 10px;
        padding: 0.72rem 0.9rem;
    }

    .cliente-dark-input::placeholder {
        color: #64748b;
    }

    .cliente-dark-input:focus {
        background-color: #ffffff;
        border-color: #5b6e91;
        color: #0f172a;
        box-shadow: 0 0 0 0.2rem rgba(72, 125, 255, 0.25);
    }

    .cliente-dark-input.is-invalid {
        border-color: #f87171;
    }

    .cliente-submit-btn {
        background: linear-gradient(180deg, #2f63ff 0%, #2050e4 100%);
        border: none;
        border-radius: 10px;
        padding: 0.62rem 1.3rem;
        font-weight: 600;
        min-width: 148px;
    }
</style>

<div class="row justify-content-center">
    <div class="col-lg-10 col-xl-9">
        <div class="cliente-create-shell">
            <h2 class="cliente-create-title">Crear cliente</h2>
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nombre_completo" class="form-label">Nombre Completo</label>
                        <input
                            type="text"
                            class="form-control cliente-dark-input @error('nombre_completo') is-invalid @enderror"
                            id="nombre_completo"
                            name="nombre_completo"
                            value="{{ old('nombre_completo') }}"
                            placeholder="Nombre completo"
                            required
                            autofocus
                        >
                        @error('nombre_completo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="correo" class="form-label">Correo</label>
                        <input
                            type="email"
                            class="form-control cliente-dark-input @error('correo') is-invalid @enderror"
                            id="correo"
                            name="correo"
                            value="{{ old('correo') }}"
                            placeholder="correo@ejemplo.com"
                            required
                        >
                        @error('correo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input
                            type="text"
                            class="form-control cliente-dark-input @error('telefono') is-invalid @enderror"
                            id="telefono"
                            name="telefono"
                            value="{{ old('telefono') }}"
                            placeholder="Telefono"
                        >
                        @error('telefono')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="direccion" class="form-label">Direccion</label>
                        <textarea
                            class="form-control cliente-dark-input @error('direccion') is-invalid @enderror"
                            id="direccion"
                            name="direccion"
                            placeholder="Direccion"
                            rows="3"
                        >{{ old('direccion') }}</textarea>
                        @error('direccion')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mt-2">
                        <button type="submit" class="btn btn-primary cliente-submit-btn">Agregar cliente</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
