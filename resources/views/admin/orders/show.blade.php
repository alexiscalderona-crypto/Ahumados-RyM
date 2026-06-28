<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Pedido #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }} - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = { theme: { extend: { colors: { primary: "#610000", "primary-container": "#8b0000" } } } }
    </script>
</head>
<body class="bg-gray-50 text-gray-900 font-sans">

<header class="fixed top-0 w-full z-50 bg-white border-b border-gray-200">
    <div class="flex flex-col md:flex-row justify-between items-center px-6 py-4 gap-2">
        <h1 class="text-xl font-bold">Ahumados R y M Admin</h1>
        <div class="flex gap-2 md:gap-4 flex-wrap justify-center">
            <a href="{{ route('admin.dashboard') }}" class="text-primary font-bold">Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-primary">Productos</a>
            <a href="{{ route('admin.claims.index') }}" class="text-gray-600 hover:text-primary">Reclamos</a>
        </div>
    </div>
</header>

<main class="pt-24 px-4 md:px-6 pb-12 max-w-5xl mx-auto">
    <div class="mb-6 flex justify-between items-end flex-wrap gap-4">
        <div>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-primary flex items-center gap-1 mb-2 text-sm font-semibold">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span> Volver al Dashboard
            </a>
            <h2 class="text-3xl font-bold">Pedido #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h2>
            <p class="text-gray-500 mt-1">Fecha: {{ $order->created_at->format('d/m/Y H:i') }}</p>
        </div>
        <div>
            <a href="{{ route('orders.invoice', $order) }}" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded shadow-sm hover:bg-gray-50 transition flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">picture_as_pdf</span> Descargar PDF
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Columna Izquierda: Detalles e Ítems -->
        <div class="md:col-span-2 space-y-6">
            
            <!-- Productos -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-4 border-b border-gray-100 font-bold text-lg bg-gray-50">Productos Comprados</div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-xs text-gray-500 uppercase">
                            <tr>
                                <th class="px-4 py-3">Producto</th>
                                <th class="px-4 py-3">Cant.</th>
                                <th class="px-4 py-3">Precio</th>
                                <th class="px-4 py-3 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($order->items as $item)
                            <tr>
                                <td class="px-4 py-3 font-semibold">{{ $item->product->title }}</td>
                                <td class="px-4 py-3">{{ $item->quantity }}</td>
                                <td class="px-4 py-3">S/. {{ number_format($item->price, 2) }}</td>
                                <td class="px-4 py-3 text-right font-bold">S/. {{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50 border-t border-gray-200">
                            <tr>
                                <td colspan="3" class="px-4 py-4 text-right font-bold text-lg">Total del Pedido:</td>
                                <td class="px-4 py-4 text-right font-bold text-xl text-primary">S/. {{ number_format($order->total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Cliente -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden p-6">
                <h3 class="font-bold text-lg mb-4 border-b pb-2">Datos del Cliente y Envío</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Cliente</p>
                        <p class="font-semibold">{{ $order->user->name }}</p>
                        <p class="text-sm text-gray-600">{{ $order->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Dirección de Envío</p>
                        <p class="font-semibold">{{ $order->address ?: 'No proporcionada' }}</p>
                        <p class="text-sm text-gray-600">{{ $order->city ?: '' }} {{ $order->zip ? '('.$order->zip.')' : '' }}</p>
                        @if($order->phone)
                            <p class="text-sm text-gray-600 mt-1"><span class="font-bold">Tel:</span> {{ $order->phone }}</p>
                        @endif
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Columna Derecha: Gestión de Estado -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-24">
                <h3 class="font-bold text-lg mb-4">Gestión del Pedido</h3>
                
                <div class="mb-6">
                    <p class="text-sm text-gray-500 mb-1">Estado Actual</p>
                    @if($order->status == 'Pendiente')
                        <span class="inline-flex items-center gap-1 px-4 py-2 rounded bg-yellow-100 text-yellow-800 font-bold w-full justify-center text-lg">Pendiente</span>
                    @elseif($order->status == 'Cancelado')
                        <span class="inline-flex items-center gap-1 px-4 py-2 rounded bg-red-100 text-red-800 font-bold w-full justify-center text-lg">Cancelado</span>
                    @else
                        <span class="inline-flex items-center gap-1 px-4 py-2 rounded bg-green-100 text-green-800 font-bold w-full justify-center text-lg">{{ $order->status }}</span>
                    @endif
                </div>

                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Actualizar Estado:</label>
                        <select name="status" class="w-full border-gray-300 rounded shadow-sm p-2 bg-gray-50 focus:border-primary focus:ring focus:ring-primary/20">
                            <option value="Pendiente" {{ $order->status == 'Pendiente' ? 'selected' : '' }}>🟡 Pendiente</option>
                            <option value="Pagado" {{ $order->status == 'Pagado' ? 'selected' : '' }}>🔵 Pagado (Confirmar pago)</option>
                            <option value="Enviado" {{ $order->status == 'Enviado' ? 'selected' : '' }}>🟣 Enviado (En camino)</option>
                            <option value="Entregado" {{ $order->status == 'Entregado' ? 'selected' : '' }}>🟢 Entregado (Finalizado)</option>
                            <option value="Cancelado" {{ $order->status == 'Cancelado' ? 'selected' : '' }}>🔴 Cancelado</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-2">Nota: Al marcar como "Pagado" o "Entregado", este pedido sumará a las Ventas del Dashboard.</p>
                    </div>
                    
                    <button type="submit" class="w-full bg-primary text-white py-3 rounded shadow hover:bg-primary-container transition font-bold uppercase tracking-wide flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">save</span> Guardar Cambios
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>
</body>
</html>
