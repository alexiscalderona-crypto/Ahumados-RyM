<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Ahumados R y M - @yield('title', 'Inicio')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&amp;family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .zoom-container:hover img {
            transform: scale(1.15);
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #8e706b;
            border-radius: 10px;
        }
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
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
                        "outline-variant": "#e3beb8",
                        "surface-container": "#eaeef3",
                        "surface-container-low": "#f0f4f9",
                        "surface-container-lowest": "#ffffff",
                    },
                    "fontFamily": {
                        "body-sm": ["Inter"],
                        "body-md": ["Inter"],
                        "body-lg": ["Inter"],
                        "headline-sm": ["Playfair Display"],
                        "headline-md": ["Playfair Display"],
                        "headline-lg": ["Playfair Display"],
                        "display-lg": ["Playfair Display"],
                        "display-lg-mobile": ["Playfair Display"],
                        "label-sm": ["Inter"],
                        "label-lg": ["Inter"],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-surface text-on-surface font-body-md overflow-x-hidden">
    <!-- Top Navigation -->
    <header class="fixed top-0 w-full z-50 bg-surface/80 backdrop-blur-md shadow-sm">
        <nav class="flex justify-between items-center px-4 md:px-8 py-4 max-w-7xl mx-auto">
            <div class="flex items-center gap-4">
                <span class="material-symbols-outlined cursor-pointer md:hidden" id="mobile-menu-btn">menu</span>
                <a class="font-headline-sm font-bold tracking-tight text-xl" href="{{ route('products.index') }}">Ahumados R y M</a>
            </div>
            <div class="hidden md:flex gap-8 items-center">
                <a class="text-on-surface-variant hover:text-primary transition-colors font-label-lg" href="{{ url('/') }}">Inicio</a>
                <a class="text-primary font-semibold border-b-2 border-primary font-label-lg" href="{{ route('products.index') }}">Colección</a>
                <div class="relative group cursor-pointer">
                    <span class="text-on-surface-variant hover:text-primary transition-colors font-label-lg flex items-center gap-1">
                        Contacto <span class="material-symbols-outlined text-sm">expand_more</span>
                    </span>
                    <div class="absolute left-0 mt-2 w-48 bg-white border border-outline/10 rounded shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="{{ route('claims.create') }}" class="block px-4 py-3 text-sm text-on-surface hover:bg-surface-variant/20 hover:text-primary transition-colors">Nuevo Reclamo</a>
                        @auth
                            @if(Auth::user()->role !== 'admin')
                                <a href="{{ route('claims.index') }}" class="block px-4 py-3 text-sm text-on-surface hover:bg-surface-variant/20 hover:text-primary transition-colors border-t border-outline/10">Mis Reclamos</a>
                            @endif
                        @endauth
                    </div>
                </div>
                @auth
                    @if(Auth::user()->role !== 'admin')
                        <a class="text-on-surface-variant hover:text-primary transition-colors font-label-lg font-bold" href="{{ route('orders.index') }}">Mis Pedidos</a>
                    @endif
                @endauth
            </div>
            <div class="flex items-center gap-4">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="material-symbols-outlined cursor-pointer text-on-surface hover:text-primary">dashboard</a>
                    @else
                        <a href="{{ route('orders.index') }}" class="material-symbols-outlined cursor-pointer text-on-surface hover:text-primary">person</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline m-0 p-0">
                        @csrf
                        <button type="submit" class="material-symbols-outlined cursor-pointer text-on-surface hover:text-primary border-none bg-transparent m-0 p-0" title="Cerrar Sesión">logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="material-symbols-outlined cursor-pointer text-on-surface hover:text-primary">person</a>
                @endauth
                <a href="{{ route('cart.index') }}" class="relative group cursor-pointer px-2 py-1 hover:bg-surface-variant/10 transition-all rounded">
                    <span class="material-symbols-outlined text-on-surface">shopping_cart</span>
                    @if(session('cart') && count(session('cart')) > 0)
                    <span class="absolute -top-1 -right-1 bg-primary text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center font-bold">
                        {{ collect(session('cart'))->sum('quantity') }}
                    </span>
                    @endif
                </a>
            </div>
        </nav>
    </header>

    <main class="pt-[100px] pb-12 px-4 md:px-8 max-w-7xl mx-auto min-h-screen">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="w-full border-t border-outline/10 bg-surface pt-12 pb-8">
        <div class="text-center px-4 max-w-7xl mx-auto">
            <h3 class="font-headline-sm font-bold text-on-surface mb-4">Ahumados R y M</h3>
            <p class="font-body-sm text-on-surface-variant max-w-xs mx-auto mb-8">Artisanal Precision in Every Smoke. Dedicados a la maestría culinaria.</p>
            <p class="font-body-sm text-outline-variant">© 2026 Ahumados R y M. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed inset-0 bg-surface/95 backdrop-blur-md z-40 hidden flex-col pt-24 px-8 md:hidden">
        <a class="text-on-surface hover:text-primary text-2xl font-semibold mb-6" href="{{ url('/') }}">Inicio</a>
        <a class="text-primary font-bold text-2xl mb-6" href="{{ route('products.index') }}">Colección</a>
        <a class="text-on-surface hover:text-primary text-2xl font-semibold mb-2" href="{{ route('claims.create') }}">Nuevo Reclamo</a>
        @auth
            @if(Auth::user()->role !== 'admin')
                <a class="text-on-surface hover:text-primary text-2xl font-semibold mb-6 pl-4 border-l-2 border-outline/20" href="{{ route('claims.index') }}">Mis Reclamos</a>
                <a class="text-on-surface hover:text-primary text-2xl font-bold mb-6 mt-4" href="{{ route('orders.index') }}">Mis Pedidos</a>
            @endif
        @endauth
    </div>

    <script>
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        let menuOpen = false;
        if(btn) {
            btn.addEventListener('click', () => {
                menuOpen = !menuOpen;
                if(menuOpen) {
                    menu.classList.remove('hidden');
                    menu.classList.add('flex');
                    btn.textContent = 'close';
                } else {
                    menu.classList.add('hidden');
                    menu.classList.remove('flex');
                    btn.textContent = 'menu';
                }
            });
        }
    </script>
</body>
</html>
