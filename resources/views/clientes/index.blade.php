@extends('layouts.app')

@section('title', 'Lista de Clientes')

@section('content')
<style>
    .cliente-index-shell {
        background: linear-gradient(135deg, #071226 0%, #0a1730 100%);
        border-radius: 16px;
        padding: 1.5rem;
        color: #f8fafc;
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25);
    }

    .cliente-index-title {
        margin: 0;
        font-size: 1.85rem;
        font-weight: 700;
        color: #f8fafc;
    }

    .cliente-index-subtitle {
        margin: 0.35rem 0 0;
        color: #cbd5e1;
        font-size: 0.95rem;
    }

    .cliente-primary-btn {
        background: linear-gradient(180deg, #2563eb 0%, #1d4ed8 100%);
        border: none;
        border-radius: 10px;
        padding: 0.62rem 1rem;
        font-weight: 600;
    }

    .cliente-primary-btn:hover {
        background: linear-gradient(180deg, #1d4ed8 0%, #1e40af 100%);
    }

    .cliente-table-wrap {
        margin-top: 1rem;
        border: 1px solid #334155;
        border-radius: 12px;
        overflow: hidden;
    }

    .cliente-table {
        margin: 0;
    }

    .cliente-table th {
        background: #111f3a;
        color: #ffffff;
        font-weight: 700;
        border-bottom: 1px solid #334155;
        white-space: nowrap;
    }

    .cliente-table td {
        background: #172641;
        color: #ffffff;
        border-top: 1px solid #334155;
        vertical-align: middle;
    }

    .cliente-table tr:hover td {
        background: #1d2f50;
    }

    .cliente-id-badge {
        display: inline-block;
        background: #2b3f63;
        color: #f8fafc;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 700;
        padding: 0.2rem 0.6rem;
        min-width: 42px;
        text-align: center;
    }

    .cliente-action-group {
        display: flex;
        gap: 0.45rem;
        flex-wrap: wrap;
    }

    .cliente-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.35rem;
        border-radius: 8px;
        min-width: 95px;
        font-weight: 600;
    }

    .cliente-action-btn svg {
        width: 14px;
        height: 14px;
    }

    @media (max-width: 768px) {
        .cliente-index-shell {
            padding: 1rem;
        }

        .cliente-index-title {
            font-size: 1.5rem;
        }

        .cliente-primary-btn {
            width: 100%;
            margin-top: 0.75rem;
        }
    }
</style>

<div class="cliente-index-shell">
    <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap mb-2">
        <div>
            <h1 class="cliente-index-title">Lista de Clientes</h1>
            <p class="cliente-index-subtitle">Administra clientes, datos de contacto y acciones rapidamente.</p>
        </div>
        <a href="{{ route('clientes.create') }}" class="btn btn-primary cliente-primary-btn">+ Crear Cliente</a>
    </div>

    @if($clientes->count() > 0)
    <div class="table-responsive cliente-table-wrap">
        <table class="table cliente-table">
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
                    <td><span class="cliente-id-badge">#{{ $cliente->id }}</span></td>
                    <td>{{ $cliente->nombre_completo }}</td>
                    <td>{{ $cliente->correo }}</td>
                    <td>{{ $cliente->telefono ?? 'Sin telefono' }}</td>
                    <td>{{ Str::limit($cliente->direccion, 50) }}</td>
                    <td>
                        <div class="cliente-action-group" role="group">
                            <a href="{{ route('clientes.show', $cliente) }}" class="btn btn-sm btn-info cliente-action-btn text-white">
                                <svg viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                                    <path d="M8 3c3.43 0 6.13 2.03 7.38 4.6a.92.92 0 0 1 0 .8C14.13 10.97 11.43 13 8 13S1.87 10.97.62 8.4a.92.92 0 0 1 0-.8C1.87 5.03 4.57 3 8 3Zm0 1.5A3.5 3.5 0 1 0 8 11.5 3.5 3.5 0 0 0 8 4.5Zm0 1.75A1.75 1.75 0 1 1 8 9.75 1.75 1.75 0 0 1 8 6.25Z"/>
                                </svg>
                                Ver
                            </a>

                            <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-warning cliente-action-btn">
                                <svg viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                                    <path d="m12.15 1.85 2 2a1.2 1.2 0 0 1 0 1.7l-7.9 7.9-3.4.5.5-3.4 7.9-7.9a1.2 1.2 0 0 1 1.7 0Zm-8.3 9.2-.24 1.63 1.63-.24 7.58-7.58-1.39-1.39-7.58 7.58Z"/>
                                </svg>
                                Editar
                            </a>

                            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline" onsubmit="return confirm('Estas seguro de eliminar este cliente?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger cliente-action-btn">
                                    <svg viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                                        <path d="M6.5 1.5h3a1 1 0 0 1 1 1V3H14v1.5H2V3h3.5v-.5a1 1 0 0 1 1-1Zm-1 4.5h1.5v6H5.5V6Zm3 0H10v6H8.5V6Zm3 0H13v6h-1.5V6ZM3.5 5.5h9v8a1 1 0 0 1-1 1h-7a1 1 0 0 1-1-1v-8Z"/>
                                    </svg>
                                    Eliminar
                                </button>
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
    <div class="alert alert-info mb-0 mt-3">
        No hay clientes registrados. <a href="{{ route('clientes.create') }}">Crea uno ahora</a>
    </div>
    @endif
</div>
@endsection
