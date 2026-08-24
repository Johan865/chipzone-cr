@extends('layouts.app')
@section('title', 'Administrar productos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0">Administrar productos</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Nuevo producto</a>
</div>

<form method="GET" class="mb-3" style="max-width:300px">
    <input type="search" name="q" class="form-control" placeholder="Buscar..." value="{{ request('q') }}">
</form>

<div class="table-responsive">
    <table class="table bg-white shadow-sm align-middle">
        <thead>
            <tr><th>Producto</th><th>Categoría</th><th>Precio</th><th>Stock</th><th>Activo</th><th></th></tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="rounded" style="width: 40px; height: 40px; object-fit: cover;">
                            <span class="fw-semibold">{{ $product->name }}</span>
                        </div>
                    </td>
                    <td>{{ $product->category->name }}</td>
                    <td>₡{{ number_format($product->price, 0) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        @if($product->active)
                            <span class="badge bg-success">Sí</span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif
                    </td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('¿Eliminar este producto?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $products->links() }}
@endsection
