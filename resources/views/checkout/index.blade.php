@extends('layouts.app')
@section('title', 'Finalizar compra')

@section('content')
<h1 class="h4 mb-4">Finalizar compra</h1>

<div class="row">
    <div class="col-md-7">
        <form method="POST" action="{{ route('checkout.store') }}">
            @csrf
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h2 class="h6">Dirección de envío</h2>
                    <textarea name="shipping_address" class="form-control" rows="2" required>{{ old('shipping_address') }}</textarea>
                </div>
            </div>

            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h2 class="h6">Método de pago</h2>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" value="credit_card" id="cc" checked>
                        <label class="form-check-label" for="cc">Tarjeta de crédito</label>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="card_number" class="form-control mt-1" placeholder="Número de tarjeta (simulado)">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" value="paypal" id="pp">
                        <label class="form-check-label" for="pp">PayPal</label>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary w-100">Confirmar pedido</button>
        </form>
    </div>

    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="h6">Resumen del pedido</h2>
                @foreach($cart->items as $item)
                    <div class="d-flex justify-content-between small">
                        <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
                        <span>₡{{ number_format($item->subtotal(), 0) }}</span>
                    </div>
                @endforeach
                <hr>
                <div class="d-flex justify-content-between"><span>Subtotal</span><span>₡{{ number_format($summary['subtotal'], 0) }}</span></div>
                <div class="d-flex justify-content-between"><span>IVA</span><span>₡{{ number_format($summary['tax'], 0) }}</span></div>
                <div class="d-flex justify-content-between"><span>Envío</span><span>₡{{ number_format($summary['shipping_cost'], 0) }}</span></div>
                <hr>
                <div class="d-flex justify-content-between fw-bold fs-5"><span>Total</span><span>₡{{ number_format($summary['total'], 0) }}</span></div>
            </div>
        </div>
    </div>
</div>
@endsection
