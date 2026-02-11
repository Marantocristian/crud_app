@extends('layouts.app')

@section('title', 'Detalle de Cliente')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2>Detalle de Cliente</h2>
                <div>
                    <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning btn-sm">Editar</a>
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary btn-sm">Volver</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">ID:</div>
                    <div class="col-sm-9">{{ $cliente->id }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">Nombre Completo:</div>
                    <div class="col-sm-9">{{ $cliente->nombre_completo }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">Correo:</div>
                    <div class="col-sm-9">{{ $cliente->correo }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">Telefono:</div>
                    <div class="col-sm-9">{{ $cliente->telefono }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 fw-bold">Direccion:</div>
                    <div class="col-sm-9">{{ $cliente->direccion }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-3 fw-bold">Creado:</div>
                    <div class="col-sm-9">{{ $cliente->created_at }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
