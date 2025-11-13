<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Relatório de Vendas</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
        }

        h1 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #f5f5f5;
        }

        .summary {
            display: flex;
            gap: 20px;
        }

        .summary div {
            font-size: 13px;
        }
    </style>
</head>

<body>
    <h1>Relatório de Vendas</h1>
    <p>
        Período:
        @if(!empty($filters['start_date']))
            {{ \Carbon\Carbon::parse($filters['start_date'])->format('d/m/Y') }}
        @else
            início
        @endif
        -
        @if(!empty($filters['end_date']))
            {{ \Carbon\Carbon::parse($filters['end_date'])->format('d/m/Y') }}
        @else
            hoje
        @endif
    </p>

    <div class="summary">
        <div><strong>Receita Total:</strong> R$ {{ number_format($summary['total_revenue'], 2, ',', '.') }}</div>
        <div><strong>Pedidos:</strong> {{ $summary['total_orders'] }}</div>
        <div><strong>Descontos:</strong> R$ {{ number_format($summary['total_discount'], 2, ',', '.') }}</div>
        <div><strong>Ticket Médio:</strong> R$ {{ number_format($summary['average_ticket'], 2, ',', '.') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Pedido</th>
                <th>Cliente</th>
                <th>Status</th>
                <th>Valor</th>
                <th>Desconto</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->order_number }}</td>
                    <td>{{ $order->user?->name ?? 'Cliente convidado' }}</td>
                    <td>{{ $statusOptions[$order->status] ?? ucfirst($order->status) }}</td>
                    <td>R$ {{ number_format($order->total_amount, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($order->total_discount ?? 0, 2, ',', '.') }}</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
