@extends('layouts.app')

@section('title', 'Crear Cliente')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2>Crear Nuevo Cliente</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('clientes.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre_completo" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control @error('nombre_completo') is-invalid @enderror"
                               id="nombre_completo" name="nombre_completo" value="{{ old('nombre_completo') }}" required autofocus>
                        @error('nombre_completo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control @error('correo') is-invalid @enderror"
                               id="correo" name="correo" value="{{ old('correo') }}" required>
                        @error('correo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control @error('telefono') is-invalid @enderror"
                               id="telefono" name="telefono" value="{{ old('telefono') }}">
                        @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" class="form-control @error('direccion') is-invalid @enderror"
                               id="direccion" name="direccion" value="{{ old('direccion') }}">
                        @error('direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Crear Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
