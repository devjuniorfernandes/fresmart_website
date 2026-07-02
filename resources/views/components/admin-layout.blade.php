<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fresmart CMS - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased text-gray-800 bg-gray-50">
    <div class="min-h-screen flex flex-col md:flex-row">

        <!-- Sidebar (Branded Design System) -->
        <aside
            class="w-full md:w-56 lg:w-64 flex-shrink-0 flex flex-col min-h-screen bg-gradient-to-b from-[#1b5314] to-[#0d270a] shadow-xl z-20">
            <div
                class="h-14 bg-[#0a1b07]/60 border-b border-white/10 flex items-center px-5 text-white font-bold text-base tracking-wider uppercase">
                <img src="/assets/img/logo-white.png" alt="" class="w-200 h-auto">
            </div>
            <nav class="flex-1 py-4 overflow-y-auto text-[13px] space-y-1">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-2.5 mx-3 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-[#45B500] text-white shadow-md' : 'text-gray-200 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-tachometer-alt w-6 text-center"></i> Painel
                </a>

                <a href="{{ route('admin.slides.index') }}"
                    class="flex items-center px-4 py-2.5 mx-3 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.slides.*') ? 'bg-[#45B500] text-white shadow-md' : 'text-gray-200 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-images w-6 text-center"></i> Slides (Capa)
                </a>
                <a href="{{ route('admin.stores.index') }}"
                    class="flex items-center px-4 py-2.5 mx-3 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.stores.*') ? 'bg-[#45B500] text-white shadow-md' : 'text-gray-200 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-store w-6 text-center"></i> Lojas
                </a>
                <a href="{{ route('admin.recipes.index') }}"
                    class="flex items-center px-4 py-2.5 mx-3 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.recipes.*') ? 'bg-[#45B500] text-white shadow-md' : 'text-gray-200 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-utensils w-6 text-center"></i> Receitas
                </a>
                <a href="{{ route('admin.campaigns.index') }}"
                    class="flex items-center px-4 py-2.5 mx-3 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.campaigns.*') ? 'bg-[#45B500] text-white shadow-md' : 'text-gray-200 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-bullhorn w-6 text-center"></i> Campanhas
                </a>
                <a href="{{ route('admin.products.index') }}"
                    class="flex items-center px-4 py-2.5 mx-3 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.products.*') ? 'bg-[#45B500] text-white shadow-md' : 'text-gray-200 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-shopping-basket w-6 text-center"></i> Produtos
                </a>
                <a href="{{ route('admin.services.index') }}"
                    class="flex items-center px-4 py-2.5 mx-3 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.services.*') ? 'bg-[#45B500] text-white shadow-md' : 'text-gray-200 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-concierge-bell w-6 text-center"></i> Serviços
                </a>
                <a href="{{ route('admin.settings.edit') }}"
                    class="flex items-center px-4 py-2.5 mx-3 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.settings.*') ? 'bg-[#45B500] text-white shadow-md' : 'text-gray-200 hover:bg-white/10 hover:text-white' }}">
                    <i class="fa fa-cog w-6 text-center"></i> Redes Sociais
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            <!-- Topbar (Modern branded layout) -->
            <header
                class="h-14 bg-[#0a1b07] flex items-center justify-between px-6 text-white text-sm border-b border-white/5 shadow-sm">
                <div class="flex items-center gap-4">
                    <a href="{{ url('/') }}" target="_blank"
                        class="hover:text-[#45B500] transition flex items-center gap-1.5 font-medium">
                        <i class="fas fa-home"></i> Ver Site
                    </a>
                </div>
                <div class="flex items-center gap-5">
                    <span class="text-gray-300 font-medium">Olá, {{ Auth::user()->name ?? 'Admin' }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="bg-white/10 hover:bg-white/20 text-white font-medium px-4 py-1.5 rounded-lg transition text-xs flex items-center gap-1">
                            <i class="fas fa-sign-out-alt"></i> Sair
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8">
                @if (isset($header))
                    <div class="mb-6 flex items-center justify-between">
                        <h1 class="text-2xl font-normal text-gray-800 font-bold tracking-tight">{{ $header }}
                        </h1>
                        {{ $actions ?? '' }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-white border-l-4 border-green-500 p-4 mb-6 shadow-sm flex items-center">
                        <p class="text-sm text-gray-700">{{ session('success') }}</p>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
