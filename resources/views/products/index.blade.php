@extends('layouts.store')

@section('title', 'Colección Premium')

@section('content')
<section class="mb-12">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h1 class="font-headline-lg text-4xl text-on-surface mb-2">Selección del Maestro</h1>
            <p class="text-on-surface-variant font-body-md">Explora nuestra colección artesanal de carnes y embutidos ahumados.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach($products as $product)
        <div class="group cursor-pointer">
            <a href="{{ route('products.show', $product->id) }}">
                <div class="relative aspect-[3/4] overflow-hidden rounded-lg mb-4 bg-surface-container shadow-sm">
                    @if($product->image_path)
                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{ $product->image_path }}" alt="{{ $product->title }}"/>
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">Sin imagen</div>
                    @endif
                    <div class="absolute bottom-0 left-0 w-full p-4 translate-y-full group-hover:translate-y-0 transition-transform bg-white/80 backdrop-blur-sm">
                        <button class="w-full py-2 bg-primary text-white text-sm font-semibold uppercase tracking-widest hover:bg-primary-container">Ver Detalles</button>
                    </div>
                </div>
                <h4 class="font-headline-sm text-lg mb-1 text-on-surface group-hover:text-primary transition-colors">{{ $product->title }}</h4>
                <div class="flex justify-between items-center mt-2">
                    <span class="font-bold text-primary">S/. {{ number_format($product->price, 2) }}</span>
                </div>
            </a>
            
            <form action="{{ route('cart.store', ['product' => $product->id]) }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="w-full py-2 border border-primary text-primary hover:bg-primary hover:text-white transition-colors rounded text-sm uppercase tracking-wide font-semibold flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-sm">add_shopping_cart</span> Añadir al Carrito
                </button>
            </form>
        </div>
        @endforeach
    </div>
    
    <div class="mt-8">
        {{ $products->links() }}
    </div>
</section>
@endsection
