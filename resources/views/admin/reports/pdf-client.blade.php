<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><style>
body { font-family: sans-serif; font-size: 12px; }
table { width: 100%; border-collapse: collapse; }
th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
</style></head>
<body>
<h2>Reporte de ventas por cliente — ChipZone CR</h2>
<p>Generado: {{ now()->format('d/m/Y H:i') }}</p>
<table>
    <thead><tr><th>Cliente</th><th>Correo</th><th>Pedidos</th><th>Total (₡)</th></tr></thead>
    <tbody>
        @foreach($data as $row)
            <tr><td>{{ $row->user->name ?? 'N/A' }}</td><td>{{ $row->user->email ?? '' }}</td><td>{{ $row->total_orders }}</td><td>{{ number_format($row->total_sales, 0) }}</td></tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
