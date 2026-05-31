<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Ahumados R y M | Iniciar Sesión</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
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
                        "on-surface-variant": "#5a403c",
                        "surface": "#f6faff",
                        "outline": "#8e706b",
                        "outline-variant": "#e3beb8",
                        "inverse-surface": "#2c3135",
                        "on-tertiary": "#ffffff",
                    },
                    "fontFamily": {
                        "body-md": ["Inter"],
                        "headline-sm": ["Playfair Display"],
                        "headline-md": ["Playfair Display"],
                        "display-lg": ["Playfair Display"],
                        "label-sm": ["Inter"],
                        "label-lg": ["Inter"],
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        .auth-image-overlay { background: linear-gradient(to bottom, rgba(23, 28, 32, 0.1), rgba(23, 28, 32, 0.4)); }
    </style>
</head>
<body class="bg-surface text-gray-900 font-body-md min-h-screen flex items-center justify-center overflow-x-hidden">
    
    <header class="fixed top-0 left-0 w-full z-50 px-6 py-4 flex justify-center">
        <h1 class="font-headline-sm text-2xl font-bold tracking-tight">
            <a href="{{ url('/') }}">Ahumados R y M</a>
        </h1>
    </header>

    <main class="w-full min-h-screen flex flex-col md:flex-row items-center justify-center">
        <section class="hidden md:flex md:w-1/2 h-screen relative items-center justify-center overflow-hidden">
            <img class="absolute inset-0 w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDckZ7t3qwDV46yEBXHy1Sh3Sej2MWebbHs9eC1Y4Te9kKgFHYpJF_IC1cqClwtEMo9dM2ORTLB-L-c-siVl9-mlmlsyJcq8rCQzQkYcHXyurRzOrEkjoe-jA5KwjLJVLfgYtxBCIsReH3jerxEG0eN_kn-_pSg2LFd3ISQMKMpGu4EwYS-csOxn-FtzGHiS1I6ZsBpRY9dpJ9u-2ihGX1JavAtqSpwVWbk8Qm9pR0QCvXiA6VOMmcB9CjhT0g0Z0m28Ghs4k6hWEXy" alt="Artisanal Smokehouse"/>
            <div class="absolute inset-0 auth-image-overlay"></div>
            <div class="relative z-10 px-12 text-center">
                <p class="font-label-lg text-white/70 uppercase tracking-widest mb-4">Established Artisans</p>
                <h2 class="font-display-lg text-5xl md:text-6xl text-white mb-6 max-w-lg leading-tight">Artisanal Precision in Every Smoke.</h2>
                <div class="w-16 h-[1px] bg-white/30 mx-auto"></div>
            </div>
        </section>

        <section class="w-full md:w-1/2 min-h-screen flex items-center justify-center px-6 py-20 bg-surface">
            <div class="w-full max-w-md">
                <div class="flex justify-center space-x-8 mb-12 border-b border-outline/10">
                    <a href="{{ route('login') }}" class="pb-4 font-label-lg border-b-2 transition-all duration-300 border-primary text-primary">
                        LOGIN
                    </a>
                    <a href="{{ route('register') }}" class="pb-4 font-label-lg border-b-2 transition-all duration-300 border-transparent text-on-surface-variant hover:text-gray-900">
                        REGISTER
                    </a>
                </div>

                <div class="space-y-8">
                    <div class="text-center md:text-left">
                        <h3 class="font-headline-md text-3xl mb-1">Welcome back.</h3>
                        <p class="text-on-surface-variant">Please enter your details to access your account.</p>
                    </div>

                    <x-auth-session-status class="mb-4 text-green-600 font-bold" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf
                        <div class="space-y-1 group">
                            <label class="font-label-sm text-xs text-on-surface-variant group-focus-within:text-primary transition-colors" for="email">EMAIL ADDRESS</label>
                            <input class="w-full bg-transparent border-0 border-b border-outline/20 focus:ring-0 focus:border-primary transition-all py-2 px-0 font-body-md placeholder-outline-variant" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
                        </div>

                        <div class="space-y-1 group">
                            <div class="flex justify-between items-center">
                                <label class="font-label-sm text-xs text-on-surface-variant group-focus-within:text-primary transition-colors" for="password">PASSWORD</label>
                                @if (Route::has('password.request'))
                                    <a class="font-label-sm text-xs text-outline hover:text-primary transition-colors" href="{{ route('password.request') }}">Forgot Password?</a>
                                @endif
                            </div>
                            <input class="w-full bg-transparent border-0 border-b border-outline/20 focus:ring-0 focus:border-primary transition-all py-2 px-0 font-body-md placeholder-outline-variant" id="password" type="password" name="password" required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
                        </div>

                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary" name="remember">
                                <span class="ms-2 text-sm text-gray-600">Remember me</span>
                            </label>
                        </div>

                        <button type="submit" class="w-full bg-inverse-surface text-on-tertiary font-label-lg py-4 px-6 shadow-sm hover:bg-primary transition-all duration-300 transform active:scale-95 uppercase tracking-widest font-bold">
                            Sign in
                        </button>
                    </form>
                </div>

                <footer class="mt-12 text-center">
                    <p class="text-sm text-outline">© 2026 Ahumados R y M. Artisanal Precision.</p>
                </footer>
            </div>
        </section>
    </main>
</body>
</html>
