@extends('layouts.app')

@section('title', 'Lista de Clientes')

@section('content')
<style>
    .cliente-index-shell {
        background: linear-gradient(135deg, #071226 0%, #0a1730 100%);
        border-radius: 12px;
        padding: 2rem;
        color: #f8fafc;
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25);
    }

    .cliente-index-title {
        margin: 0;
        font-size: 2rem;
        font-weight: 700;
    }

    .cliente-primary-btn {
        background: linear-gradient(180deg, #2f63ff 0%, #2050e4 100%);
        border: none;
        border-radius: 10px;
        padding: 0.62rem 1.1rem;
        font-weight: 600;
    }

    .cliente-dark-table {
        margin-top: 1.25rem;
        color: #e2e8f0;
        border-color: #334155;
    }

    .cliente-dark-table th {
        background: #111f3a;
        color: #f8fafc;
        font-weight: 600;
        border-bottom: 1px solid #334155;
    }

    .cliente-dark-table td {
        background: #172641;
        border-top: 1px solid #334155;
        vertical-align: middle;
    }

    .cliente-dark-table tr:hover td {
        background: #1d2f50;
    }

    .cliente-action-btn {
        border-radius: 8px;
        min-width: 84px;
        font-weight: 600;
    }
</style>

<div class="cliente-index-shell">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="cliente-index-title">Lista de Clientes</h1>
        <a href="{{ route('clientes.create') }}" class="btn btn-primary cliente-primary-btn">Crear Cliente</a>
    </div>

    @if($clientes->count() > 0)
    <div class="table-responsive">
        <table class="table cliente-dark-table">
            <thead>
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
                    <td>{{ $cliente->correo }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ Str::limit($cliente->direccion, 50) }}</td>
                    <td>
                        <div class="d-flex gap-2" role="group">
                            <a href="{{ route('clientes.show', $cliente) }}" class="btn btn-sm btn-info cliente-action-btn">Ver</a>
                            <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-warning cliente-action-btn">Editar</a>
                            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline" onsubmit="return confirm('Estas seguro de eliminar este cliente?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger cliente-action-btn">Eliminar</button>
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
    <div class="alert alert-info mb-0">
        No hay clientes registrados. <a href="{{ route('clientes.create') }}">Crea uno ahora</a>
    </div>
    @endif
</div>
@endsection
