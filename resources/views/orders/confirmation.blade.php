@extends('layouts.app')
@section('title', 'ConfirmaciÃ³n de pedido')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h1 class="h4">Â¡Gracias por tu compra!</h1>
        <p>Cliente: <strong>{{ $order->user->name }} ({{ $order->user->email }})</strong></p>
        <p>Fecha de compra: <strong>{{ $order->created_at->format('d/m/Y H:i') }}</strong></p>
        <p>NÃºmero de seguimiento: <strong>{{ $order->tracking_number }}</strong></p>
        <p>Estado: <span class="badge bg-success">{{ $order->status }}</span></p>
        <p>DirecciÃ³n de envÃ­o: {{ $order->shipping_address }}</p>

        <hr>
        <h2 class="h6">Detalle del pedido</h2>
        <table class="table">
            <thead><tr><th>Producto</th><th>Cantidad</th><th>Precio unit.</th><th>Subtotal</th></tr></thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>â‚¡{{ number_format($item->unit_price, 0) }}</td>
                        <td>â‚¡{{ number_format($item->unit_price * $item->quantity, 0) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end">
            <p class="mb-1">Subtotal: â‚¡{{ number_format($order->subtotal, 0) }}</p>
            <p class="mb-1">IVA: â‚¡{{ number_format($order->tax, 0) }}</p>
            <p class="mb-1">EnvÃ­o: â‚¡{{ number_format($order->shipping_cost, 0) }}</p>
            <p class="fw-bold fs-5">Total: â‚¡{{ number_format($order->total, 0) }}</p>
        </div>

        <a href="{{ route('home') }}" class="btn btn-primary">Seguir comprando</a>
    </div>
</div>
@endsection
