@extends('layouts.app')
@section('title', 'Confirmación de pedido')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h1 class="h4">¡Gracias por tu compra!</h1>
        <p>Número de seguimiento: <strong>{{ $order->tracking_number }}</strong></p>
        <p>Estado: <span class="badge bg-success">{{ $order->status }}</span></p>
        <p>Dirección de envío: {{ $order->shipping_address }}</p>

        <hr>
        <h2 class="h6">Detalle del pedido</h2>
        <table class="table">
            <thead><tr><th>Producto</th><th>Cantidad</th><th>Precio unit.</th><th>Subtotal</th></tr></thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₡{{ number_format($item->unit_price, 0) }}</td>
                        <td>₡{{ number_format($item->unit_price * $item->quantity, 0) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end">
            <p class="mb-1">Subtotal: ₡{{ number_format($order->subtotal, 0) }}</p>
            <p class="mb-1">IVA: ₡{{ number_format($order->tax, 0) }}</p>
            <p class="mb-1">Envío: ₡{{ number_format($order->shipping_cost, 0) }}</p>
            <p class="fw-bold fs-5">Total: ₡{{ number_format($order->total, 0) }}</p>
        </div>

        <a href="{{ route('home') }}" class="btn btn-primary">Seguir comprando</a>
    </div>
</div>
@endsection
