@extends('layouts.store')

@section('title', 'Finalizar Compra')

@section('content')
<h1 class="font-headline-lg text-4xl mb-8">Finalizar Compra</h1>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div>
        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-bold mb-4">Información de Envío</h2>
            <p class="text-gray-600 mb-4">Estás comprando como: <strong>{{ Auth::user()->name }}</strong> ({{ Auth::user()->email }})</p>
            
            <form id="checkout-form" action="{{ route('orders.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Dirección de Entrega</label>
                    <input type="text" name="address" class="w-full border-gray-300 rounded shadow-sm" required placeholder="Av. Principal 123">
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Ciudad</label>
                        <input type="text" name="city" class="w-full border-gray-300 rounded shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Referencia</label>
                        <input type="text" name="zip" class="w-full border-gray-300 rounded shadow-sm" required placeholder="Ej: Al costado de la bodega Don Pepe">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Teléfono</label>
                    <input type="text" name="phone" class="w-full border-gray-300 rounded shadow-sm" required>
                </div>
            </form>
        </div>
        
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Método de Pago</h2>
            
            <label class="border border-gray-300 rounded p-4 flex items-center gap-4 mb-4 hover:bg-gray-50 cursor-pointer">
                <input type="radio" name="payment_method" value="contra_entrega" checked class="text-primary h-5 w-5" onchange="document.getElementById('yape-section').classList.add('hidden')">
                <span class="font-bold text-lg">Pago a contra entrega</span>
            </label>
            
            <label class="border border-gray-300 rounded p-4 flex items-center gap-4 mb-4 hover:bg-gray-50 cursor-pointer">
                <input type="radio" name="payment_method" value="yape" class="text-primary h-5 w-5" onchange="document.getElementById('yape-section').classList.remove('hidden')">
                <span class="font-bold text-lg text-purple-700 flex items-center gap-2">
                    Transferencia / Yape
                    <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded">Recomendado</span>
                </span>
            </label>

            <!-- Yape Section -->
            <div id="yape-section" class="hidden mt-4 p-4 border border-purple-200 bg-purple-50 rounded-lg">
                <h3 class="font-bold text-purple-800 mb-2">Instrucciones de Pago:</h3>
                <p class="text-sm text-gray-700 mb-4">1. Escanea el código QR o transfiere al número <strong>918 503 005</strong> (Titular: Ahumados R y M).</p>
                <div class="flex justify-center items-center w-full mb-6 mt-2">
                    <div class="w-48 h-48 bg-white p-2 rounded-xl shadow-md border border-purple-200 flex justify-center items-center">
                        <img src="{{ asset('img/qr_yape.jpg') }}" alt="QR de Yape" class="max-w-full max-h-full object-contain mx-auto block">
                    </div>
                </div>
                <p class="text-sm text-gray-700 mb-2">2. Adjunta la captura de pantalla de tu transferencia:</p>
                <input type="file" name="voucher" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-100 file:text-purple-700 hover:file:bg-purple-200">
            </div>
        </div>
    </div>
    
    <div>
        <div class="bg-white shadow rounded-lg p-6 sticky top-24">
            <h2 class="text-xl font-bold mb-4">Resumen del Pedido</h2>
            
            <div class="border-b pb-4 mb-4 max-h-60 overflow-y-auto custom-scrollbar">
                @foreach($cart as $item)
                <div class="flex justify-between items-center mb-2">
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-500">{{ $item['quantity'] }}x</span>
                        <span class="font-semibold">{{ $item['title'] }}</span>
                    </div>
                    <span>S/. {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                </div>
                @endforeach
            </div>
            
            <div class="flex justify-between mb-2">
                <span>Subtotal:</span>
                <span class="font-bold">S/. {{ number_format($total, 2) }}</span>
            </div>
            <div class="flex justify-between mb-4">
                <span>Envío:</span>
                <span>Gratis</span>
            </div>
            <div class="border-t pt-4 flex justify-between mb-6">
                <span class="text-lg font-bold">Total:</span>
                <span class="text-lg font-bold text-primary">S/. {{ number_format($total, 2) }}</span>
            </div>
            
            <button onclick="document.getElementById('checkout-form').submit()" class="block w-full py-3 bg-primary text-white text-center font-bold rounded uppercase tracking-wide hover:bg-primary-container transition-colors">
                Confirmar Pedido
            </button>
        </div>
    </div>
</div>
@endsection
