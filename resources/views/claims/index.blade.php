@extends('layouts.store')
@section('title', 'Mis Reclamos')

@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-8 py-12">
    <div class="flex items-center justify-between mb-8">
        <h1 class="font-headline-lg text-4xl font-bold text-on-surface">Mis Reclamos</h1>
        <a href="{{ route('claims.create') }}" class="bg-primary text-white px-4 py-2 rounded shadow hover:bg-primary-container transition-colors">
            Nuevo Reclamo
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($claims->count() > 0)
        <div class="space-y-6">
            @foreach($claims as $claim)
                <div class="bg-white rounded-lg shadow p-6 border-l-4 {{ $claim->status === 'resolved' ? 'border-green-500' : 'border-yellow-500' }}">
                    <div class="flex flex-col md:flex-row justify-between md:items-center mb-4 border-b pb-4">
                        <div>
                            <h2 class="text-xl font-bold">{{ $claim->subject }}</h2>
                            <p class="text-sm text-gray-500">Fecha: {{ $claim->created_at->format('d/m/Y H:i') }}</p>
                            @if($claim->order_reference)
                                <p class="text-sm font-semibold text-primary mt-1">Ref. Pedido: #{{ $claim->order_reference }}</p>
                            @endif
                        </div>
                        <div class="mt-4 md:mt-0">
                            @if($claim->status === 'resolved')
                                <span class="bg-green-100 text-green-800 font-bold px-3 py-1 rounded-full text-sm">Resuelto</span>
                            @else
                                <span class="bg-yellow-100 text-yellow-800 font-bold px-3 py-1 rounded-full text-sm">En Revisión</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h3 class="font-bold text-gray-700 mb-2">Tu Mensaje:</h3>
                        <p class="text-gray-600 bg-gray-50 p-4 rounded">{{ $claim->message }}</p>
                    </div>

                    @if($claim->image_data)
                        <div class="mb-4">
                            <h3 class="font-bold text-gray-700 mb-2">Evidencia:</h3>
                            <img src="{{ $claim->image_data }}" alt="Evidencia del reclamo" class="w-32 h-32 object-cover rounded border">
                        </div>
                    @endif

                    @if($claim->status === 'resolved' && $claim->admin_reply)
                        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h3 class="font-bold text-blue-900 mb-2 flex items-center gap-2">
                                <span class="material-symbols-outlined">support_agent</span>
                                Respuesta de Administración:
                            </h3>
                            <p class="text-blue-800">{{ $claim->admin_reply }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white shadow rounded-lg p-8 text-center">
            <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">forum</span>
            <p class="text-gray-500 text-lg">No tienes reclamos o mensajes registrados.</p>
        </div>
    @endif
</div>
@endsection
