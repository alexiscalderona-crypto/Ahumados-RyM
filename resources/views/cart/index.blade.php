@extends('layouts.store')

@section('title', 'Carrito de Compras')

@section('content')
<h1 class="font-headline-lg text-4xl mb-8">Tu Carrito de Compras</h1>

@if(count($cart) > 0)
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
        <div class="bg-white shadow rounded-lg p-6">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th class="pb-3 font-semibold">Producto</th>
                        <th class="pb-3 font-semibold">Precio</th>
                        <th class="pb-3 font-semibold text-center">Cantidad</th>
                        <th class="pb-3 font-semibold text-right">Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $details)
                    <tr class="border-b">
                        <td class="py-4 flex items-center gap-4">
                            @php $cartProduct = \App\Models\Product::find($id); @endphp
                            @if($cartProduct && $cartProduct->image_path)
                                <img src="{{ $cartProduct->image_path }}" alt="{{ $details['title'] }}" class="w-16 h-16 object-cover rounded">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded"></div>
                            @endif
                            <span class="font-semibold">{{ $details['title'] }}</span>
                        </td>
                        <td class="py-4">S/. {{ number_format($details['price'], 2) }}</td>
                        <td class="py-4 text-center">
                            <form action="{{ route('cart.update', ['cart' => $id]) }}" method="POST" class="inline-flex items-center">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="w-16 text-center border-gray-300 rounded" onchange="this.form.submit()">
                            </form>
                        </td>
                        <td class="py-4 text-right font-bold">S/. {{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                        <td class="py-4 text-right">
                            <form action="{{ route('cart.destroy', ['cart' => $id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="lg:col-span-1">
        <div class="bg-white shadow rounded-lg p-6 sticky top-24">
            <h2 class="text-xl font-bold mb-4">Resumen del Pedido</h2>
            <div class="flex justify-between mb-2">
                <span>Subtotal:</span>
                <span class="font-bold">S/. {{ number_format($total, 2) }}</span>
            </div>
            <div class="flex justify-between mb-4">
                <span>Envío:</span>
                <span>Calculado en checkout</span>
            </div>
            <div class="border-t pt-4 flex justify-between mb-6">
                <span class="text-lg font-bold">Total:</span>
                <span class="text-lg font-bold text-primary">S/. {{ number_format($total, 2) }}</span>
            </div>
            <a href="{{ route('orders.create') }}" class="block w-full py-3 bg-primary text-white text-center font-bold rounded uppercase tracking-wide hover:bg-primary-container transition-colors">
                Proceder al Pago
            </a>
            <a href="{{ route('products.index') }}" class="block w-full py-3 text-primary text-center font-bold rounded uppercase tracking-wide hover:bg-gray-50 mt-2 transition-colors">
                Continuar Comprando
            </a>
        </div>
    </div>
</div>
@else
<div class="text-center py-16 bg-white shadow rounded-lg">
    <span class="material-symbols-outlined text-6xl text-gray-400 mb-4">shopping_cart</span>
    <h2 class="text-2xl font-bold text-gray-700 mb-4">Tu carrito está vacío</h2>
    <p class="text-gray-500 mb-8">Parece que aún no has añadido nuestros deliciosos ahumados a tu carrito.</p>
    <a href="{{ route('products.index') }}" class="inline-block px-8 py-3 bg-primary text-white font-bold rounded uppercase tracking-wide hover:bg-primary-container transition-colors">
        Explorar Colección
    </a>
</div>
@endif
@endsection
