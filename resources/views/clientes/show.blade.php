@extends('layouts.app')

@section('title', 'Detalle de Cliente')

@section('content')
<style>
    .cliente-show-shell {
        background: linear-gradient(135deg, #071226 0%, #0a1730 100%);
        border-radius: 12px;
        padding: 2rem;
        color: #f8fafc;
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25);
    }

    .cliente-show-title {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
    }

    .cliente-show-table {
        margin-top: 1.25rem;
        color: #ffffff;
        border-color: #334155;
    }

    .cliente-show-table th {
        width: 220px;
        background: #111f3a;
        color: #ffffff;
        border: 1px solid #334155;
        font-weight: 600;
    }

    .cliente-show-table td {
        background: #172641;
        color: #ffffff;
        border: 1px solid #334155;
        word-break: break-word;
    }

    .cliente-primary-btn {
        background: linear-gradient(180deg, #2f63ff 0%, #2050e4 100%);
        border: none;
        border-radius: 10px;
        padding: 0.5rem 1rem;
        font-weight: 600;
    }

    .cliente-secondary-btn {
        border-radius: 10px;
        padding: 0.5rem 1rem;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .cliente-show-shell {
            padding: 1.5rem 1rem;
        }

        .cliente-show-shell .d-flex.justify-content-between {
            flex-direction: column;
            align-items: stretch !important;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .cliente-show-title {
            font-size: 1.5rem;
            text-align: center;
        }

        .cliente-show-shell .d-flex.gap-2 {
            flex-direction: column;
            width: 100%;
        }

        .cliente-primary-btn, .cliente-secondary-btn {
            width: 100%;
            text-align: center;
        }

        .cliente-show-table {
            display: block;
        }

        .cliente-show-table tbody, .cliente-show-table tr, .cliente-show-table th, .cliente-show-table td {
            display: block;
            width: 100%;
        }

        .cliente-show-table tr {
            margin-bottom: 1rem;
            border: 1px solid #334155;
            border-radius: 8px;
            overflow: hidden;
        }

        .cliente-show-table th {
            border: none;
            border-bottom: 1px solid #334155;
            background: #111f3a;
            padding: 0.75rem 1rem;
        }

        .cliente-show-table td {
            border: none;
            padding: 0.75rem 1rem;
        }
    }
</style>

<div class="row justify-content-center">
    <div class="col-lg-10 col-xl-9">
        <div class="cliente-show-shell">
            <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
                <h2 class="cliente-show-title">Detalle de cliente</h2>
                <div class="d-flex gap-2">
                    <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-primary cliente-primary-btn">Editar</a>
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary cliente-secondary-btn">Volver</a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table cliente-show-table mb-0">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $cliente->id }}</td>
                        </tr>
                        <tr>
                            <th>Nombre Completo</th>
                            <td>{{ $cliente->nombre_completo }}</td>
                        </tr>
                        <tr>
                            <th>Correo</th>
                            <td>{{ $cliente->correo }}</td>
                        </tr>
                        <tr>
                            <th>Telefono</th>
                            <td>{{ $cliente->telefono }}</td>
                        </tr>
                        <tr>
                            <th>Direccion</th>
                            <td>{{ $cliente->direccion }}</td>
                        </tr>
                        <tr>
                            <th>Creado</th>
                            <td>{{ $cliente->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
