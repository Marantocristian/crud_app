@extends('layouts.app')

@section('title', 'Lista de Clientes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Lista de Clientes</h1>
    <a href="{{ route('clientes.create') }}" class="btn btn-primary">Nuevo Cliente</a>
</div>

@if($clientes->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nombre_completo }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->phone }}</td>
                    <td>{{ Str::limit($cliente->address, 50) }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('clientes.show', $cliente) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline" onsubmit="return confirm('Estas seguro de eliminar este cliente?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $clientes->links() }}
    </div>
@else
    <div class="alert alert-info">
        No hay clientes registrados. <a href="{{ route('clientes.create') }}">Crea uno ahora</a>
    </div>
@endif
@endsection
