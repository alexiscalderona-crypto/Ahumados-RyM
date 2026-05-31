@extends('layouts.store')

@section('title', 'Mis Pedidos')

@section('content')
<h1 class="font-headline-lg text-4xl mb-8">Mis Pedidos</h1>

@if($orders->count() > 0)
<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="p-4 font-semibold text-gray-600">Pedido #</th>
                <th class="p-4 font-semibold text-gray-600">Fecha</th>
                <th class="p-4 font-semibold text-gray-600">Total</th>
                <th class="p-4 font-semibold text-gray-600">Estado</th>
                <th class="p-4 font-semibold text-gray-600">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach($orders as $order)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="p-4 font-bold">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                <td class="p-4 text-gray-600">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                <td class="p-4 font-bold">S/. {{ number_format($order->total, 2) }}</td>
                <td class="p-4">
                    @if($order->status == 'pending')
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">Pendiente</span>
                    @elseif($order->status == 'paid')
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Pagado</span>
                    @else
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-semibold">{{ ucfirst($order->status) }}</span>
                    @endif
                </td>
                <td class="p-4">
                    <a href="{{ route('orders.show', $order->id) }}" class="text-primary hover:underline font-semibold">Ver detalles</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="text-center py-16 bg-white shadow rounded-lg">
    <span class="material-symbols-outlined text-6xl text-gray-400 mb-4">receipt_long</span>
    <h2 class="text-2xl font-bold text-gray-700 mb-4">Aún no tienes pedidos</h2>
    <a href="{{ route('products.index') }}" class="inline-block px-8 py-3 bg-primary text-white font-bold rounded uppercase tracking-wide hover:bg-primary-container transition-colors">
        Explorar Colección
    </a>
</div>
@endif
@endsection
