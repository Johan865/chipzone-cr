@extends('layouts.app')
@section('title', $product->name)

@section('content')
<div class="row">
    <div class="col-md-5">
        <img src="{{ $product->image_url }}" class="img-fluid rounded shadow-sm" alt="{{ $product->name }}">
    </div>
    <div class="col-md-7">
        <p class="text-muted mb-1">{{ $product->category->name }}</p>
        <h1 class="h3">{{ $product->name }}</h1>
        <p class="fs-4 fw-bold text-primary">₡{{ number_format($product->price, 0) }}</p>
        <p>{{ $product->description }}</p>
        <p class="small text-muted">Stock disponible: {{ $product->stock }}</p>

        @auth
            <form method="POST" action="{{ route('cart.store', $product) }}" class="d-flex gap-2 align-items-center">
                @csrf
                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control" style="width:90px">
                <button class="btn btn-primary">Agregar al carrito</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">Inicia sesión para comprar</a>
        @endauth
    </div>
</div>

@if($related->isNotEmpty())
    <hr class="my-4">
    <h2 class="h5">Productos relacionados</h2>
    <div class="row row-cols-2 row-cols-md-4 g-3">
        @foreach($related as $item)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $item->image_url }}" class="card-img-top" alt="{{ $item->name }}">
                    <div class="card-body">
                        <h3 class="h6"><a href="{{ route('products.show', $item) }}" class="text-decoration-none text-dark">{{ $item->name }}</a></h3>
                        <p class="fw-bold">₡{{ number_format($item->price, 0) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
