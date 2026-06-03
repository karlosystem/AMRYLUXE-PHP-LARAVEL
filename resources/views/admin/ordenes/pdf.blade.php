<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Guía de Despacho - {{ $order->order_number }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .section-title { background: #eee; padding: 5px; font-weight: bold; margin-top: 20px; }
        .info-table { width: 100%; margin-top: 10px; border-collapse: collapse; }
        .info-table td { padding: 5px; vertical-align: top; }
        .items-table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        .items-table th { background: #333; color: #fff; padding: 8px; text-align: left; }
        .items-table td { border-bottom: 1px solid #ddd; padding: 8px; }
        .total-area { margin-top: 20px; text-align: right; font-size: 14px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>AMRY LUXE</h1>
        <p>Guía de Despacho | Pedido: {{ $order->order_number }}</p>
        <p>Fecha de emisión: {{ date('d/m/Y H:i') }}</p>
        @if($order->tracking_number)
            <p><strong>Número de Seguimiento:</strong> {{ $order->tracking_number }}</p>
        @endif
    </div>

    <div class="section-title">DATOS DEL CLIENTE Y ENVÍO</div>
    <table class="info-table">
        <tr>
            <td><strong>Nombre:</strong> {{ $order->shipping_name }}</td>
            <td><strong>Teléfono:</strong> {{ $order->shipping_phone }}</td>
        </tr>
        <tr>
            <td><strong>Dirección:</strong> {{ $order->shipping_street_address }}</td>
            <td><strong>Distrito:</strong> {{ $order->shipping_district }}</td>
        </tr>
        <tr>
            <td><strong>Provincia/Dpto:</strong> {{ $order->shipping_province }} / {{ $order->shipping_departament }}</td>
            <td><strong>Método Pago:</strong> {{ strtoupper($order->payment_method) }}</td>
        </tr>
    </table>

    <div class="section-title">RESUMEN DE PRODUCTOS</div>
    <table class="items-table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Color/Talla</th>
                <th>Cant.</th>
                <th>Precio Unit.</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->color }} / {{ $item->size }}</td>
                <td>{{ number_format($item->quantity, 0) }}</td>
                <td>S/ {{ number_format($item->price, 2) }}</td>
                <td>S/ {{ number_format($item->total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-area">
        <p><strong>Total a Cobrar: S/ {{ number_format($order->total_amount, 2) }}</strong></p>
    </div>

    <div style="margin-top: 50px; text-align: center; color: #999;">
        <p>Gracias por confiar en la calidad de AMRY LUXE.</p>
    </div>
</body>
</html>