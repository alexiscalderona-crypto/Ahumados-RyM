<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Comprobante de Pedido #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 14px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #555; padding-bottom: 20px; }
        .logo { font-size: 28px; font-weight: bold; color: #b71c1c; margin-bottom: 5px; }
        .slogan { font-size: 12px; font-style: italic; color: #666; }
        .info-section { margin-bottom: 30px; }
        .info-section p { margin: 5px 0; }
        table { w-full; border-collapse: collapse; margin-top: 20px; width: 100%; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f4f4f4; }
        .total-row th { text-align: right; }
        .total { font-size: 18px; font-weight: bold; color: #b71c1c; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #777; border-top: 1px solid #eee; padding-top: 10px; }
    </style>
</head>
<body>

    <div class="header">
        <div class="logo">Ahumados R y M</div>
        <div class="slogan">Tradición y sabor artesanal en cada corte</div>
        <p>RUC: 20123456789 | Av. Los Ahumadores 123, Lima, Perú</p>
    </div>

    <div class="info-section">
        <table style="border: none;">
            <tr>
                <td style="border: none; width: 50%;">
                    <strong>Datos del Cliente:</strong><br>
                    Nombre: {{ $order->user->name }}<br>
                    Email: {{ $order->user->email }}
                </td>
                <td style="border: none; width: 50%; text-align: right;">
                    <strong>Comprobante Interno:</strong> #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}<br>
                    <strong>Fecha:</strong> {{ $order->created_at->format('d/m/Y H:i') }}<br>
                    <strong>Estado:</strong> {{ ucfirst($order->status) }}
                </td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unit.</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->title }}</td>
                <td>{{ $item->quantity }}</td>
                <td>S/ {{ number_format($item->price, 2) }}</td>
                <td>S/ {{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <th colspan="3">TOTAL A PAGAR:</th>
                <td class="total">S/ {{ number_format($order->total, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Gracias por su preferencia.</p>
        <p><em>Este documento es un comprobante interno del sistema, válido para entrega de productos.</em></p>
    </div>

</body>
</html>
