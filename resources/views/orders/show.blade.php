@extends('layouts.store')

@section('title', 'Detalle del Pedido #' . str_pad($order->id, 5, '0', STR_PAD_LEFT))

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="font-headline-lg text-4xl">Pedido #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h1>
    <a href="{{ route('orders.index') }}" class="text-primary hover:underline font-semibold flex items-center gap-1">
        <span class="material-symbols-outlined">arrow_back</span> Volver a mis pedidos
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
        <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
            <div class="p-6 border-b bg-gray-50 flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Fecha del pedido</p>
                    <p class="font-bold">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Estado</p>
                    @if($order->status == 'pending')
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold inline-block mt-1">Pendiente de Pago</span>
                    @elseif($order->status == 'paid')
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold inline-block mt-1">Pagado</span>
                    @else
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-semibold inline-block mt-1">{{ ucfirst($order->status) }}</span>
                    @endif
                </div>
            </div>
            
            <div class="p-0">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="p-4 font-semibold text-gray-600">Producto</th>
                            <th class="p-4 font-semibold text-gray-600 text-center">Cantidad</th>
                            <th class="p-4 font-semibold text-gray-600 text-right">Precio unitario</th>
                            <th class="p-4 font-semibold text-gray-600 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($order->items as $item)
                        <tr>
                            <td class="p-4 flex items-center gap-4">
                                @if($item->product && $item->product->image_path)
                                    <img src="{{ $item->product->image_path }}" alt="{{ $item->product->title }}" class="w-12 h-12 object-cover rounded">
                                @else
                                    <div class="w-12 h-12 bg-gray-200 rounded"></div>
                                @endif
                                <span class="font-semibold">{{ $item->product ? $item->product->title : 'Producto Eliminado' }}</span>
                            </td>
                            <td class="p-4 text-center">{{ $item->quantity }}</td>
                            <td class="p-4 text-right">S/. {{ number_format($item->price, 2) }}</td>
                            <td class="p-4 text-right font-bold">S/. {{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="lg:col-span-1">
        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <h2 class="text-xl font-bold mb-4 border-b pb-2">Resumen</h2>
            <div class="flex justify-between mb-2">
                <span class="text-gray-600">Subtotal:</span>
                <span class="font-semibold">S/. {{ number_format($order->total, 2) }}</span>
            </div>
            <div class="flex justify-between mb-4 border-b pb-4">
                <span class="text-gray-600">Envío:</span>
                <span class="font-semibold">Gratis</span>
            </div>
            <div class="flex justify-between">
                <span class="text-lg font-bold">Total:</span>
                <span class="text-lg font-bold text-primary">S/. {{ number_format($order->total, 2) }}</span>
            </div>
        </div>
        
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4 border-b pb-2">Información del Cliente</h2>
            <p class="font-semibold mb-1">{{ $order->user->name }}</p>
            <p class="text-gray-600 mb-4">{{ $order->user->email }}</p>
            
            <h3 class="font-semibold mb-2">Método de Pago</h3>
            <p class="text-gray-600">Pago a contra entrega</p>
        </div>
    </div>
</div>
@endsection
