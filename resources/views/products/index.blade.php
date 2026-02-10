@extends('layouts.app')

@section('title', 'Lista de Productos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Lista de Productos</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Nuevo Producto</a>
</div>

@if($products->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ Str::limit($product->description, 50) }}</td>
                    <td>${{ number_format($product->price) }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
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
        {{ $products->links() }}
    </div>
@else
    <div class="alert alert-info">
        No hay productos registrados. <a href="{{ route('products.create') }}">Crea uno ahora</a>
    </div>
@endif
@endsection
