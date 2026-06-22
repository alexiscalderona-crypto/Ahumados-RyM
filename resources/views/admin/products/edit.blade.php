<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Editar Producto | Admin</title>
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

<main class="pt-24 px-6 pb-12 max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold">Editar Producto: {{ $product->title }}</h2>
        </div>
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-bold mb-2">Nombre del Producto</label>
                <input type="text" name="title" required class="w-full border-gray-300 rounded p-3 focus:border-primary focus:ring-0" value="{{ old('title', $product->title) }}">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-bold mb-2">Descripción</label>
                <textarea name="description" rows="4" required class="w-full border-gray-300 rounded p-3 focus:border-primary focus:ring-0">{{ old('description', $product->description) }}</textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block font-bold mb-2">Precio (S/.)</label>
                    <input type="number" step="0.01" name="price" required class="w-full border-gray-300 rounded p-3 focus:border-primary focus:ring-0" value="{{ old('price', $product->price) }}">
                    @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block font-bold mb-2">Stock Disponible</label>
                    <input type="number" name="stock" required class="w-full border-gray-300 rounded p-3 focus:border-primary focus:ring-0" value="{{ old('stock', $product->stock) }}">
                    @error('stock') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block font-bold mb-2">Imagen del Producto</label>
                <div class="flex items-center gap-4 mb-3">
                    <img src="{{ Str::startsWith($product->image_path, ['http', 'data:image']) ? $product->image_path : asset($product->image_path) }}" class="w-20 h-20 object-cover rounded border border-gray-300">
                    <span class="text-sm text-gray-500">Imagen Actual</span>
                </div>
                <input type="file" name="image" accept="image/*" class="w-full border border-gray-300 rounded p-3 bg-gray-50">
                <p class="text-sm text-gray-500 mt-1">Sube una nueva imagen solo si quieres reemplazar la actual.</p>
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="pt-4 flex justify-end gap-4">
                <a href="{{ route('admin.products.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded hover:bg-gray-50">Cancelar</a>
                <button type="submit" class="px-6 py-3 bg-primary text-white font-bold rounded hover:bg-red-900 transition">Actualizar Producto</button>
            </div>
        </form>
    </div>
</main>

</body>
</html>
