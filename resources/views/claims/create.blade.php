@extends('layouts.store')
@section('title', 'Contacto y Reclamos')

@section('content')
<div class="max-w-3xl mx-auto py-12">
    <div class="bg-surface-container-lowest p-8 md:p-12 rounded-2xl shadow-sm border border-outline/10">
        <div class="text-center mb-10">
            <h1 class="font-headline-lg text-4xl font-bold text-on-surface mb-4">Contacto y Reclamos</h1>
            <p class="text-on-surface-variant font-body-lg">
                Valoramos tu opinión. Si tienes alguna sugerencia, reclamo o duda sobre nuestros productos, déjanos un mensaje.
            </p>
        </div>

        <form action="{{ route('claims.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block font-label-lg text-sm text-on-surface-variant mb-2 uppercase">Nombre Completo</label>
                    <input type="text" name="name" id="name" required class="w-full bg-surface-container-low border-0 border-b border-outline/20 focus:ring-0 focus:border-primary transition-all py-3 px-4 font-body-md" value="{{ auth()->check() ? auth()->user()->name : '' }}">
                </div>
                <div>
                    <label for="email" class="block font-label-lg text-sm text-on-surface-variant mb-2 uppercase">Correo Electrónico</label>
                    <input type="email" name="email" id="email" required class="w-full bg-surface-container-low border-0 border-b border-outline/20 focus:ring-0 focus:border-primary transition-all py-3 px-4 font-body-md" value="{{ auth()->check() ? auth()->user()->email : '' }}">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="subject" class="block font-label-lg text-sm text-on-surface-variant mb-2 uppercase">Asunto / Motivo</label>
                    <input type="text" name="subject" id="subject" required class="w-full bg-surface-container-low border-0 border-b border-outline/20 focus:ring-0 focus:border-primary transition-all py-3 px-4 font-body-md">
                </div>
                <div>
                    <label for="order_reference" class="block font-label-lg text-sm text-on-surface-variant mb-2 uppercase">N° de Pedido (Opcional)</label>
                    <input type="text" name="order_reference" id="order_reference" placeholder="Ej: 00001" class="w-full bg-surface-container-low border-0 border-b border-outline/20 focus:ring-0 focus:border-primary transition-all py-3 px-4 font-body-md">
                </div>
            </div>

            <div>
                <label for="message" class="block font-label-lg text-sm text-on-surface-variant mb-2 uppercase">Mensaje o Detalle</label>
                <textarea name="message" id="message" rows="5" required class="w-full bg-surface-container-low border-0 border-b border-outline/20 focus:ring-0 focus:border-primary transition-all py-3 px-4 font-body-md resize-none"></textarea>
            </div>

            <div>
                <label for="image" class="block font-label-lg text-sm text-on-surface-variant mb-2 uppercase">Adjuntar Evidencia (Foto del producto - Opcional)</label>
                <input type="file" name="image" id="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-all font-body-md">
            </div>

            <button type="submit" class="w-full bg-primary text-white font-label-lg py-4 px-6 hover:bg-primary-container transition-all active:scale-95 uppercase tracking-widest font-bold">
                Enviar Mensaje
            </button>
        </form>
    </div>
</div>
@endsection
