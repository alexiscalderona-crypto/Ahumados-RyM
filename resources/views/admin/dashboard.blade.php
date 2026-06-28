<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard Admin | Ahumados R y M</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&amp;family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#610000",
                        "on-primary": "#ffffff",
                        "primary-container": "#8b0000",
                        "on-primary-container": "#ff907f",
                        "surface": "#f6faff",
                        "on-surface": "#171c20",
                        "surface-variant": "#dfe3e8",
                        "on-surface-variant": "#5a403c",
                        "outline": "#8e706b",
                        "surface-container": "#eaeef3",
                        "surface-container-low": "#f0f4f9",
                        "surface-container-highest": "#dfe3e8",
                        "error": "#ba1a1a",
                        "error-container": "#ffdad6",
                    },
                    "fontFamily": {
                        "body-sm": ["Inter"],
                        "body-md": ["Inter"],
                        "body-lg": ["Inter"],
                        "headline-sm": ["Playfair Display"],
                        "headline-md": ["Playfair Display"],
                        "headline-lg": ["Playfair Display"],
                        "label-sm": ["Inter"],
                        "label-lg": ["Inter"],
                    }
                }
            }
        }
    </script>
    <style>
      .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
      body { background-color: #f6faff; color: #171c20; min-height: max(884px, 100dvh); }
      .custom-scrollbar::-webkit-scrollbar { width: 4px; }
      .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
      .custom-scrollbar::-webkit-scrollbar-thumb { background: #e3beb8; border-radius: 10px; }
    </style>
</head>
<body class="font-body-md text-body-md overflow-x-hidden">

<!-- TopAppBar -->
<header class="fixed top-0 w-full z-50 bg-surface/80 backdrop-blur-md shadow-sm transition-all duration-300">
    <div class="flex justify-between items-center px-6 py-4 mx-auto">
        <div class="flex items-center gap-4">
            <button class="md:hidden cursor-pointer active:scale-95 transition-transform duration-200 text-on-surface" id="mobile-menu-toggle">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <h1 class="font-headline-sm text-2xl font-bold tracking-tight text-on-surface">Ahumados R y M</h1>
        </div>
        <div class="hidden md:flex items-center gap-8">
            <nav class="flex gap-6">
                <a class="text-primary font-semibold border-b-2 border-primary cursor-pointer active:scale-95 transition-transform duration-200" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors cursor-pointer active:scale-95 transition-transform duration-200" href="#">Productos</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors cursor-pointer active:scale-95 transition-transform duration-200" href="{{ route('products.index') }}" target="_blank">Ver Tienda</a>
            </nav>
        </div>
        <div class="flex items-center gap-4">
            <div class="h-8 w-8 rounded-full bg-surface-container-highest flex items-center justify-center overflow-hidden border border-outline/10 text-xs font-bold text-gray-500 uppercase">
                {{ substr(Auth::user()->name, 0, 2) }}
            </div>
        </div>
    </div>
</header>

<!-- Sidebar -->
<aside class="fixed left-0 top-0 h-full w-64 bg-white border-r border-outline/5 pt-20 z-40 transition-transform duration-300 -translate-x-full md:translate-x-0" id="sidebar">
    <div class="px-4 py-6 flex flex-col h-full">
        <div class="flex flex-col gap-1 mb-8">
            <a class="flex items-center gap-4 p-4 rounded-xl bg-red-50 text-primary font-semibold transition-all duration-200" href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">dashboard</span>
                <span class="font-label-lg">Dashboard</span>
            </a>
            <a class="flex items-center gap-4 p-4 rounded-xl text-on-surface-variant hover:bg-gray-50 transition-all duration-200 group" href="{{ route('admin.products.index') }}">
                <span class="material-symbols-outlined group-hover:text-primary transition-colors">restaurant_menu</span>
                <span class="font-label-lg">Productos</span>
            </a>
            <a class="flex items-center gap-4 p-4 rounded-xl text-on-surface-variant hover:bg-gray-50 transition-all duration-200 group" href="{{ route('admin.claims.index') }}">
                <span class="material-symbols-outlined group-hover:text-primary transition-colors">mail</span>
                <span class="font-label-lg">Reclamos</span>
            </a>
            <!-- 
            <a class="flex items-center gap-4 p-4 rounded-xl text-on-surface-variant hover:bg-gray-50 transition-all duration-200 group" href="{{ route('admin.production.index') }}">
                <span class="material-symbols-outlined group-hover:text-primary transition-colors">precision_manufacturing</span>
                <span class="font-label-lg">Producción</span>
            </a>
            -->
        </div>
        <div class="mt-auto border-t border-outline/10 pt-4 pb-8">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex w-full items-center gap-4 p-4 rounded-xl text-red-600 hover:bg-red-50 transition-all duration-200">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="font-label-lg">Cerrar Sesión</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Main Content Area -->
<main class="md:ml-64 pt-24 px-6 pb-12 min-h-screen">
    <div class="mx-auto mt-4">
        
        <!-- Hero Stats Bento Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm relative overflow-hidden">
                <div class="flex justify-between items-start relative z-10">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Ventas (Pagadas)</p>
                        <h2 class="text-3xl font-bold text-gray-800">S/. {{ number_format($totalSales, 2) }}</h2>
                    </div>
                    <div class="bg-green-50 p-2 rounded-lg text-green-600">
                        <span class="material-symbols-outlined">payments</span>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm relative overflow-hidden">
                <div class="flex justify-between items-start relative z-10">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Pedidos Totales</p>
                        <h2 class="text-3xl font-bold text-gray-800">{{ $totalOrders }}</h2>
                    </div>
                    <div class="bg-blue-50 p-2 rounded-lg text-blue-600">
                        <span class="material-symbols-outlined">shopping_basket</span>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm relative overflow-hidden">
                <div class="flex justify-between items-start relative z-10">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Alertas de Inventario</p>
                        <h2 class="text-3xl font-bold text-gray-800">{{ $lowStock }}</h2>
                        <div class="flex items-center gap-1 mt-2 text-red-600 font-semibold text-sm">
                            <span class="material-symbols-outlined text-[18px]">warning</span>
                            <span>Stock Bajo</span>
                        </div>
                    </div>
                    <div class="bg-red-50 p-2 rounded-lg text-red-600">
                        <span class="material-symbols-outlined">priority_high</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders Table -->
        <section class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Pedidos Recientes</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                            <th class="px-6 py-4 font-semibold">ID Pedido</th>
                            <th class="px-6 py-4 font-semibold">Cliente</th>
                            <th class="px-6 py-4 font-semibold">Fecha</th>
                            <th class="px-6 py-4 font-semibold">Monto</th>
                            <th class="px-6 py-4 font-semibold">Estado</th>
                            <th class="px-6 py-4 font-semibold text-right">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($orders as $order)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-semibold text-primary">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-6 py-4 flex items-center gap-2">
                                <div>
                                    <div class="font-bold text-sm">{{ $order->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $order->user->email }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-sm">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 font-bold text-gray-800">S/. {{ number_format($order->total, 2) }}</td>
                            <td class="px-6 py-4">
                                @if($order->status == 'Pendiente')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-semibold">Pendiente</span>
                                @elseif($order->status == 'Cancelado')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-red-100 text-red-800 text-xs font-semibold">Cancelado</span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-primary hover:text-primary-container font-semibold text-sm inline-flex items-center gap-1">
                                    Ver Detalle <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>

<script>
    const sidebar = document.getElementById('sidebar');
    const menuToggle = document.getElementById('mobile-menu-toggle');
    let isOpen = false;

    menuToggle.addEventListener('click', () => {
        isOpen = !isOpen;
        if (isOpen) {
            sidebar.classList.remove('-translate-x-full');
        } else {
            sidebar.classList.add('-translate-x-full');
        }
    });
</script>
</body>
</html>
