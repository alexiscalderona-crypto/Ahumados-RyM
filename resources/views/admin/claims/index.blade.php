<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Reclamos | Admin</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&amp;family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            theme: {
                extend: {
                    colors: { primary: "#610000" }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-900 font-sans">

<header class="fixed top-0 w-full z-50 bg-white border-b border-gray-200">
    <div class="flex justify-between items-center px-6 py-4">
        <h1 class="text-xl font-bold">Ahumados R y M Admin</h1>
        <div class="flex gap-4">
            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-primary">Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-primary">Productos</a>
            <a href="{{ route('admin.claims.index') }}" class="text-primary font-bold">Reclamos</a>
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
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold">Bandeja de Reclamos y Sugerencias</h2>
        </div>
        <div class="p-6">
            @if($claims->isEmpty())
                <p class="text-gray-500">No hay reclamos pendientes.</p>
            @else
                <div class="space-y-6">
                    @foreach($claims as $claim)
                    <div class="border {{ $claim->status == 'resolved' ? 'border-green-200 bg-green-50' : 'border-gray-200' }} rounded-lg p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-bold text-lg">{{ $claim->subject }}</h3>
                                <p class="text-sm text-gray-500">De: {{ $claim->name }} ({{ $claim->email }}) - {{ $claim->created_at->diffForHumans() }}</p>
                            </div>
                            <div>
                                @if($claim->status == 'pending')
                                    <span class="bg-yellow-100 text-yellow-800 text-xs px-3 py-1 rounded-full font-bold">Pendiente</span>
                                @else
                                    <span class="bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full font-bold">Resuelto</span>
                                @endif
                            </div>
                        </div>
                        <p class="text-gray-700 mb-4 bg-white p-4 rounded border border-gray-100">{{ $claim->message }}</p>
                        
                        @if($claim->status == 'pending')
                        <form action="{{ route('admin.claims.resolve', $claim) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bg-primary text-white px-4 py-2 rounded text-sm hover:bg-red-900 transition">Marcar como Resuelto</button>
                        </form>
                        @endif
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</main>

</body>
</html>
