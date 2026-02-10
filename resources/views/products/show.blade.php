@extends('layouts.app')

@section('title', 'Ver Producto')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2>Detalles del Producto</h2>
                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Editar</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th width="200">ID</th>
                            <td>{{ $product->id }}</td>
                        </tr>
                        <tr>
                            <th>Nombre</th>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>Descripción</th>
                            <td>{{ $product->description ?? 'Sin descripción' }}</td>
                        </tr>
                        <tr>
                            <th>Precio</th>
                            <td>${{ number_format($product->price, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Cantidad</th>
                            <td>{{ $product->quantity }}</td>
                        </tr>
                        <tr>
                            <th>Creado</th>
                            <td>{{ $product->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Actualizado</th>
                            <td>{{ $product->updated_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Volver</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" 
                          onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar Producto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
