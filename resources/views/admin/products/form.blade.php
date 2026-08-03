@extends('layouts.app')
@section('title', $product->exists ? 'Editar producto' : 'Nuevo producto')

@section('content')
<h1 class="h4 mb-4">{{ $product->exists ? 'Editar producto' : 'Nuevo producto' }}</h1>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}">
            @csrf
            @if($product->exists) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <select name="category_id" class="form-select" required>
                    <option value="">-- Selecciona --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Precio (₡)</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">URL de imagen</label>
                    <input type="url" name="image_url" class="form-control" value="{{ old('image_url', $product->image_url) }}">
                </div>
            </div>

            <div class="form-check mb-3">
                <input type="hidden" name="active" value="0">
                <input type="checkbox" name="active" value="1" class="form-check-input" id="active" @checked(old('active', $product->active ?? true))>
                <label class="form-check-label" for="active">Producto activo (visible en la tienda)</label>
            </div>

            <button class="btn btn-primary">{{ $product->exists ? 'Guardar cambios' : 'Crear producto' }}</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
