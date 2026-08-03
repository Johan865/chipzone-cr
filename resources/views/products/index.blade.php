@extends('layouts.app')
@section('title', 'Catálogo — ChipZone CR')

@section('content')
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="h6">Categorías</h2>
                <ul class="list-unstyled mb-0">
                    <li class="mb-1"><a href="{{ route('home') }}" class="text-decoration-none">Todas</a></li>
                    @foreach($categories as $category)
                        <li class="mb-1">
                            <a href="{{ route('categories.show', $category) }}" class="text-decoration-none">
                                {{ $category->name }} <span class="text-muted">({{ $category->products_count }})</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="card shadow-sm mt-3">
            <div class="card-body">
                <h2 class="h6">Filtrar por precio (₡)</h2>
                <form method="GET">
                    <input type="hidden" name="q" value="{{ request('q') }}">
                    <div class="input-group input-group-sm mb-2">
                        <span class="input-group-text">Min</span>
                        <input type="number" name="min" class="form-control" value="{{ request('min') }}">
                    </div>
                    <div class="input-group input-group-sm mb-2">
                        <span class="input-group-text">Max</span>
                        <input type="number" name="max" class="form-control" value="{{ request('max') }}">
                    </div>
                    <button class="btn btn-sm btn-outline-primary w-100">Aplicar</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <h1 class="h4 mb-3">{{ $activeCategory->name ?? 'Catálogo de productos' }}</h1>

        <div class="row row-cols-2 row-cols-md-3 g-3">
            @forelse($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body d-flex flex-column">
                            <h3 class="h6"><a href="{{ route('products.show', $product) }}" class="text-decoration-none text-dark">{{ $product->name }}</a></h3>
                            <p class="fw-bold mt-auto mb-2">₡{{ number_format($product->price, 0) }}</p>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-primary">Ver producto</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">No se encontraron productos con esos filtros.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>

        @if($recentlyViewed->isNotEmpty())
            <hr>
            <h2 class="h6">Vistos recientemente</h2>
            <div class="d-flex gap-2 overflow-auto pb-2">
                @foreach($recentlyViewed as $item)
                    <a href="{{ route('products.show', $item) }}" class="text-decoration-none text-dark" style="min-width:120px">
                        <img src="{{ $item->image_url }}" class="rounded" width="100" height="100" style="object-fit:cover">
                        <p class="small mt-1 mb-0">{{ Str::limit($item->name, 20) }}</p>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
