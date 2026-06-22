@extends('layouts.store')

@section('title', $product->title)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 mt-8">
    <!-- Main Image -->
    <div class="lg:col-span-7 flex flex-col md:flex-row gap-4">
        <div class="flex-1 order-1 md:order-2">
            <div class="relative aspect-square overflow-hidden bg-surface-container rounded-lg shadow-sm">
                @if($product->image_path)
                    <img class="w-full h-full object-cover" src="{{ $product->image_path }}" alt="{{ $product->title }}"/>
                @else
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">Sin imagen</div>
                @endif
                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 text-xs font-semibold uppercase tracking-widest text-primary border border-primary/10 rounded">
                    Premium
                </div>
            </div>
        </div>
    </div>
    
    <!-- Product Info -->
    <div class="lg:col-span-5 flex flex-col pt-4">
        <nav class="mb-4 flex gap-2 text-sm font-semibold text-outline">
            <a class="hover:text-on-surface" href="{{ route('products.index') }}">Productos</a>
            <span>/</span>
            <span class="text-on-surface">{{ $product->category->name }}</span>
        </nav>
        <h1 class="font-headline-lg text-4xl text-on-surface leading-tight mb-2">{{ $product->title }}</h1>
        <div class="flex items-baseline gap-4 mb-8">
            <span class="font-headline-md text-3xl text-primary">S/. {{ number_format($product->price, 2) }}</span>
        </div>
        
        <div class="space-y-6 mb-10">
            <div class="p-6 bg-surface-container-low border border-outline/5 rounded-lg shadow-sm">
                <p class="font-body-md text-on-surface-variant leading-relaxed">
                    {{ $product->description }}
                </p>
                @if($product->stock > 0)
                    <p class="text-green-600 mt-4 font-semibold text-sm">Disponibles: {{ $product->stock }}</p>
                @else
                    <p class="text-red-600 mt-4 font-semibold text-sm">Agotado</p>
                @endif
            </div>
            
            @if($product->stock > 0)
            <form action="{{ route('cart.store', ['product' => $product->id]) }}" method="POST">
                @csrf
                <button type="submit" class="w-full h-14 bg-primary text-white font-bold text-lg tracking-widest uppercase flex items-center justify-center gap-2 hover:bg-primary-container transition-all rounded shadow-md">
                    Agregar al Carrito
                </button>
            </form>
            @endif
        </div>
    </div>
</div>

@endsection
