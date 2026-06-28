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
        <div class="logo">Ahumados R & M</div>
        <div class="slogan" style="font-weight: bold; margin-bottom: 3px; color: #333;">De: Miranda Amasifuen Amasifuen</div>
        <div class="slogan" style="font-size: 10px; margin-bottom: 8px;">VENTA DE CHORIZO, CECINA Y TODOS SUS DERIVADOS AL POR MAYOR Y MENOR</div>
        <p style="font-size: 10px; margin: 2px 0;">JR. VENCEDORES DE COMAINAS S/N - MERCADO N°03, PTO. 15-16</p>
        <p style="font-size: 10px; margin: 2px 0;">SAN MARTIN - SAN MARTIN - TARAPOTO | CEL.: 926 306 631 / 928 978 807</p>
        <p style="font-size: 12px; font-weight: bold; margin-top: 5px;">R.U.C. 10442082702</p>
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
