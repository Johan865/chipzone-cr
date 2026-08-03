@extends('layouts.app')
@section('title', 'Reportes de ventas')

@section('content')
<h1 class="h4 mb-4">Reportes de ventas</h1>

<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <h2 class="h6">Ventas por mes</h2>
                <table class="table table-sm">
                    <thead><tr><th>Mes</th><th>Pedidos</th><th>Total</th></tr></thead>
                    <tbody>
                        @foreach($byMonth as $row)
                            <tr><td>{{ $row->month }}</td><td>{{ $row->total_orders }}</td><td>₡{{ number_format($row->total_sales, 0) }}</td></tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('admin.reports.month.pdf') }}" class="btn btn-sm btn-outline-primary">Descargar PDF</a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <h2 class="h6">Ventas por cliente</h2>
                <table class="table table-sm">
                    <thead><tr><th>Cliente</th><th>Pedidos</th><th>Total</th></tr></thead>
                    <tbody>
                        @foreach($byClient as $row)
                            <tr><td>{{ $row->user->name ?? 'N/A' }}</td><td>{{ $row->total_orders }}</td><td>₡{{ number_format($row->total_sales, 0) }}</td></tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('admin.reports.client.pdf') }}" class="btn btn-sm btn-outline-primary">Descargar PDF</a>
            </div>
        </div>
    </div>
</div>
@endsection
