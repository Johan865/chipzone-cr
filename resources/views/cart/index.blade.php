@extends('layouts.app')
@section('title', 'Mi carrito')

@section('content')
<h1 class="h4 mb-4">Mi carrito de compras</h1>

@if($cart->items->isEmpty())
    <p class="text-muted">Tu carrito está vacío. <a href="{{ route('home') }}">Ver catálogo</a></p>
@else
    <div class="table-responsive">
        <table class="table align-middle bg-white shadow-sm">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>₡{{ number_format($item->product->price, 0) }}</td>
                        <td style="width:120px">
                            <form method="POST" action="{{ route('cart.update', $item) }}" class="d-flex gap-1">
                                @csrf @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="0" class="form-control form-control-sm">
                                <button class="btn btn-sm btn-outline-secondary">↻</button>
                            </form>
                        </td>
                        <td>₡{{ number_format($item->subtotal(), 0) }}</td>
                        <td>
                            <form method="POST" action="{{ route('cart.destroy', $item) }}">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row justify-content-end">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between"><span>Subtotal</span><span>₡{{ number_format($summary['subtotal'], 0) }}</span></div>
                    <div class="d-flex justify-content-between"><span>IVA (13%)</span><span>₡{{ number_format($summary['tax'], 0) }}</span></div>
                    <div class="d-flex justify-content-between"><span>Envío</span><span>{{ $summary['shipping_cost'] == 0 ? 'Gratis' : '₡'.number_format($summary['shipping_cost'], 0) }}</span></div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5"><span>Total</span><span>₡{{ number_format($summary['total'], 0) }}</span></div>
                    <a href="{{ route('checkout.create') }}" class="btn btn-primary w-100 mt-3">Continuar con la compra</a>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
