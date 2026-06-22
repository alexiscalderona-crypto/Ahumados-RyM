<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Productos | Admin</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&amp;family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = { theme: { extend: { colors: { primary: "#610000" } } } }
    </script>
</head>
<body class="bg-gray-50 text-gray-900 font-sans">

<header class="fixed top-0 w-full z-50 bg-white border-b border-gray-200">
    <div class="flex justify-between items-center px-6 py-4">
        <h1 class="text-xl font-bold">Ahumados R y M Admin</h1>
        <div class="flex gap-4">
            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-primary">Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="text-primary font-bold">Productos</a>
            <a href="{{ route('admin.claims.index') }}" class="text-gray-600 hover:text-primary">Reclamos</a>
        </div>
    </div>
</header>

<main class="pt-24 px-6 pb-12 max-w-7xl mx-auto">
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-2xl font-bold">Catálogo de Productos</h2>
            <a href="{{ route('admin.products.create') }}" class="bg-primary text-white px-4 py-2 rounded hover:bg-red-900 transition flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">add</span> Nuevo Producto
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-500 text-sm">
                    <tr>
                        <th class="px-6 py-3">Imagen</th>
                        <th class="px-6 py-3">Nombre</th>
                        <th class="px-6 py-3">Precio</th>
                        <th class="px-6 py-3">Stock</th>
                        <th class="px-6 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <img src="{{ Str::startsWith($product->image_path, 'http') ? $product->image_path : asset($product->image_path) }}" class="w-16 h-16 object-cover rounded">
                        </td>
                        <td class="px-6 py-4 font-bold">{{ $product->title }}</td>
                        <td class="px-6 py-4">S/. {{ number_format($product->price, 2) }}</td>
                        <td class="px-6 py-4">
                            @if($product->stock <= 5)
                                <span class="text-red-600 font-bold">{{ $product->stock }} (Bajo)</span>
                            @else
                                <span class="text-green-600 font-bold">{{ $product->stock }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:text-blue-800 mr-3">Editar</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar producto?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

</body>
</html>
