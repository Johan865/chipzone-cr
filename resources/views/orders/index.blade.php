@extends('layouts.app')
@section('title', 'Mis pedidos')

@section('content')
<h1 class="h4 mb-4">Historial de pedidos</h1>

@if($orders->isEmpty())
    <p class="text-muted">Aún no tienes pedidos. <a href="{{ route('home') }}">Ir al catálogo</a></p>
@else
    <div class="table-responsive">
        <table class="table bg-white shadow-sm">
            <thead>
                <tr><th>N° seguimiento</th><th>Fecha</th><th>Estado</th><th>Total</th><th></th></tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->tracking_number }}</td>
                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                        <td><span class="badge bg-secondary">{{ $order->status }}</span></td>
                        <td>₡{{ number_format($order->total, 0) }}</td>
                        <td><a href="{{ route('orders.confirmation', $order) }}" class="btn btn-sm btn-outline-primary">Ver detalle</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $orders->links() }}
@endif
@endsection
