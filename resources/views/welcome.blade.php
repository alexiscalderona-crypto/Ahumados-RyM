<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Ahumados R y M | Premium Smokehouse</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Playfair+Display:wght@600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .glass-nav { backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#610000",
                        "on-primary": "#ffffff",
                        "primary-container": "#8b0000",
                        "on-primary-container": "#ff907f",
                        "surface": "#f6faff",
                        "on-surface": "#171c20",
                        "surface-variant": "#dfe3e8",
                        "on-surface-variant": "#5a403c",
                        "outline": "#8e706b",
                        "surface-container-low": "#f0f4f9",
                        "surface-container-highest": "#dfe3e8",
                        "surface-container-lowest": "#ffffff",
                        "inverse-surface": "#2c3135",
                        "inverse-on-surface": "#edf1f6",
                    },
                    fontFamily: {
                        "body-sm": ["Inter"], "body-md": ["Inter"], "body-lg": ["Inter"],
                        "headline-sm": ["Playfair Display"], "headline-md": ["Playfair Display"], "headline-lg": ["Playfair Display"],
                        "display-lg": ["Playfair Display"], "display-lg-mobile": ["Playfair Display"],
                        "label-sm": ["Inter"], "label-lg": ["Inter"],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-surface text-on-surface font-body-md selection:bg-primary-container selection:text-on-primary-container">

<header class="fixed top-0 w-full z-50 bg-surface/80 backdrop-blur-md shadow-sm transition-all duration-300">
    <div class="flex justify-between items-center px-6 py-4 max-w-7xl mx-auto">
        <div class="flex items-center gap-4">
            <h1 class="font-headline-sm text-2xl font-bold tracking-tight text-on-surface">Ahumados R y M</h1>
        </div>
        <nav class="hidden md:flex items-center gap-8">
            <a class="text-primary font-semibold border-b-2 border-primary font-label-lg" href="{{ url('/') }}">Inicio</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors font-label-lg" href="{{ route('products.index') }}">Colección</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors font-label-lg" href="{{ route('claims.create') }}">Contacto</a>
        </nav>
        <div class="flex items-center gap-4">
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="material-symbols-outlined text-on-surface cursor-pointer hover:text-primary">dashboard</a>
                @else
                    <a href="{{ route('orders.index') }}" class="material-symbols-outlined text-on-surface cursor-pointer hover:text-primary">person</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="material-symbols-outlined text-on-surface cursor-pointer hover:text-primary" title="Cerrar Sesión">logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="material-symbols-outlined text-on-surface cursor-pointer hover:text-primary" title="Iniciar Sesión">person</a>
            @endauth
            
            <a href="{{ route('cart.index') }}" class="bg-primary text-on-primary px-4 py-1.5 rounded-lg font-label-lg hover:bg-primary-container transition-all active:scale-95 flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">shopping_cart</span> Cart
            </a>
        </div>
    </div>
</header>

<main class="pt-[64px]">
    <!-- Hero Section -->
    <section class="relative h-[751px] w-full flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0 bg-black">
            <img alt="Artisanal Smoked Meats" class="w-full h-full object-cover brightness-50" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB8-XfhXyI4K89aUfOZwPPet3MUDrBmnXEmb3TgJsXjR4InuZJ3K3EyfOlUtN9YnJkNkFppSeq4VNX2_ylxkflh_q_0712ldlxNe_SPSdAKqpa1xxxZf1Qa4X3Pt6sLQyCPlr3V3hcHabOhGiGQEGe1qn9ED6tnbozLK3r0Va-rvQpEQ1PZdk1a_i_p7w67ySSzDIHiRbtNwjPrqK_wpos-0S7jg2oALtYEpBbKajSkI2jwDoDbjs9aN4i3SSnWOQ7VWlJiUz9qTkU8"/>
        </div>
        <div class="relative z-10 text-center px-6 max-w-4xl">
            <h2 class="font-display-lg text-4xl md:text-6xl text-white mb-4 leading-tight font-bold">El auténtico sabor ahumado artesanal</h2>
            <p class="font-headline-sm text-2xl text-white/90 mb-12 max-w-2xl mx-auto italic">Tradición y exclusividad en cada bocado.</p>
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <a href="{{ route('products.index') }}" class="bg-white text-primary px-12 py-4 rounded-lg font-label-lg font-bold hover:bg-primary-container hover:text-on-primary-container transition-all shadow-xl active:scale-95 inline-block uppercase tracking-wide">Comprar Ahora</a>
            </div>
        </div>
    </section>

    {{-- 
    ======================================================================
    SECCIÓN CATEGORÍAS (OCULTA TEMPORALMENTE)
    Descomentar cuando la dueña decida activar las categorías.
    ======================================================================
    <!-- Categories / Bento Grid -->
    <section class="py-20 px-6 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 h-auto md:h-[600px]">
            <a href="{{ route('products.index') }}" class="md:col-span-8 group relative overflow-hidden rounded-xl cursor-pointer block">
                <img alt="Embutidos Artesanales" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBx6-DXmXOyK9g8DPQ54mVRP06PmuCXJ1cmTZnNhbQ_uZ2X-N9BfWGw7ZwdGcT2QphvVxUGxY7RmJCSfIEG0YT9e5YRfIv5vhQpIR_2PhvvoyKQv0P0pzgPBWUZN9ExHY_wF7uvoZzXuZVkQtjKcXplWCgvKC7cPMQUYhHNU5thHuJ_nZGTqKkG7_li3_7njmIONGRS99F4uaNKjW1U9QgthDr3ORwRuSmam0w5bU_ZHDd9fjg_uXJeZ_siiIg037ErNmEUS83UW8fE"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col justify-end p-8">
                    <span class="text-white/80 font-label-sm uppercase tracking-widest mb-1">Colección Principal</span>
                    <h3 class="text-white font-headline-md text-3xl">Embutidos Premium</h3>
                </div>
            </a>
            <div class="md:col-span-4 grid grid-rows-2 gap-6">
                <a href="{{ route('products.index') }}" class="group relative overflow-hidden rounded-xl cursor-pointer block">
                    <img alt="Carnes Selectas" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDqq6P00iX2Pip0o44TGYFZCw7pIYzVKH6TCEyFFkRDU00KRW8WXe4VjJ4S_MTzE1UdF5MgEq6TFXrjSTt4fzqEBzV500npD3vMuC6tkkgTCUbmKTEI0OU16qja0NHp5s5zV_yIItkHiBTlEO2YH3Ol3hABKdDaVq0RuMJWob58-2opBVtr7-SbZyfHKgraZG4DhpQuViN-W0oSPQnoowXW3yb56Audn2mmG4yyWmV2jv4VCBwbTYpxXSqoiwUzN9GfeSEDn4ERkQJ1"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col justify-end p-6">
                        <h3 class="text-white font-headline-sm text-2xl">Carnes Selectas</h3>
                    </div>
                </a>
                <a href="{{ route('products.index') }}" class="group relative overflow-hidden rounded-xl cursor-pointer block">
                    <img alt="Packs Especiales" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDWJ3zHF1PqGAS7imEvIZpfpzlJjWI8lGPws1XhNvia2aveolsm2egtJ6tVTARv6aIjJcmxboLaJtn_ILogpofqIW5GaMEaBnZIOVY1u6yIcAPUqcpJNIiJrXq96pNcymd3hw06fJ7GR7tz6Qupo5lJglbD_3yXvxzkBF23JWiVvYr0d-L4XgVNwk-9ngd4EZ4qyAzbGDcI8skjVZ2fL9zmGZncGZedwBDuJRYgjjsfWN7BkhucCmkaXngQzdks1nBjDmOtCqLiP36l"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col justify-end p-6">
                        <h3 class="text-white font-headline-sm text-2xl">Packs y Regalos</h3>
                    </div>
                </a>
            </div>
        </div>
    </section>
    --}}

    <!-- Beneficios -->
    <section class="py-20 bg-inverse-surface text-inverse-on-surface">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="text-center p-6 group">
                    <div class="w-16 h-16 bg-primary/20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-primary transition-all duration-300">
                        <span class="material-symbols-outlined text-primary group-hover:text-white text-3xl">workspace_premium</span>
                    </div>
                    <h3 class="font-headline-sm text-2xl mb-4">Calidad Insuperable</h3>
                    <p class="text-outline font-body-md text-gray-400">Seleccionamos solo los mejores cortes de animales criados en libertad para garantizar una textura y sabor excepcionales.</p>
                </div>
                <div class="text-center p-6 group">
                    <div class="w-16 h-16 bg-primary/20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-primary transition-all duration-300">
                        <span class="material-symbols-outlined text-primary group-hover:text-white text-3xl">precision_manufacturing</span>
                    </div>
                    <h3 class="font-headline-sm text-2xl mb-4">Ahumado Lento</h3>
                    <p class="text-outline font-body-md text-gray-400">Respetamos los tiempos de la naturaleza. Procesos de hasta 72 horas para lograr la profundidad de sabor que nos caracteriza.</p>
                </div>
                <div class="text-center p-6 group">
                    <div class="w-16 h-16 bg-primary/20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-primary transition-all duration-300">
                        <span class="material-symbols-outlined text-primary group-hover:text-white text-3xl">local_shipping</span>
                    </div>
                    <h3 class="font-headline-sm text-2xl mb-4">Entrega Gourmet</h3>
                    <p class="text-outline font-body-md text-gray-400">Nuestros productos viajan en empaques especializados al vacío que mantienen la frescura y el aroma hasta su mesa.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="w-full border-t border-outline/10 bg-surface pt-20 pb-12">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 px-6 max-w-7xl mx-auto">
        <div class="col-span-1 md:col-span-1">
            <h4 class="font-headline-sm text-xl font-bold text-on-surface mb-4">Ahumados R y M</h4>
            <p class="text-on-surface-variant font-body-sm mb-6 italic">"Artisanal Precision in Every Smoke."</p>
        </div>
        <div>
            <h5 class="font-label-lg font-bold mb-4">Explorar</h5>
            <ul class="space-y-2">
                <li><a class="text-on-surface-variant hover:text-primary transition-colors font-body-sm" href="{{ route('products.index') }}">Colección</a></li>
            </ul>
        </div>
        <div>
            <h5 class="font-label-lg font-bold mb-4">Ayuda</h5>
            <ul class="space-y-2">
                <li><a class="text-on-surface-variant hover:text-primary transition-colors font-body-sm" href="{{ route('claims.create') }}">Contacto</a></li>
            </ul>
        </div>
    </div>
    <div class="mt-12 pt-6 border-t border-outline/5 max-w-7xl mx-auto px-6 text-center">
        <p class="text-on-surface-variant font-body-sm">© 2026 Ahumados R y M. Artisanal Precision in Every Smoke.</p>
    </div>
</footer>

<script>
    // Simple parallax for hero
    window.addEventListener('scroll', function() {
        const scroll = window.pageYOffset;
        const heroImage = document.querySelector('section img');
        if (heroImage) {
            heroImage.style.transform = `translateY(${scroll * 0.2}px)`;
        }
    });
</script>
</body>
</html>
