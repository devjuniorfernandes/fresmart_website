<header class="sticky top-0 z-50 w-full shadow-xl">
    <!-- Row 1: Logo + Main Nav + App -->
    <div class="bg-[#45B500] w-full">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10 h-[76px] flex items-center gap-6">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex-shrink-0">
                <img src="{{ $settings->logo ? asset($settings->logo) : asset('assets/img/logo-white.png') }}" alt="FRESMART" class="h-14 w-auto">
            </a>

            <!-- Desktop Nav Links -->
            <div class="hidden md:flex items-stretch h-full font-bold text-white text-[13px] tracking-wide">
                <a href="{{ route('home') }}" class="uppercase flex items-center px-4 border-b-[3px] {{ request()->routeIs('home') ? 'border-white' : 'border-transparent' }} hover:border-white/60 hover:bg-white/10 transition whitespace-nowrap">INÍCIO</a>
                
                <!-- Products Hover Dropdown -->
                <div class="relative group flex items-stretch">
                    <a href="{{ route('products.index') }}" class="uppercase flex items-center px-4 border-b-[3px] {{ request()->routeIs('products.*') ? 'border-white' : 'border-transparent' }} hover:border-white/60 hover:bg-white/10 transition gap-1.5 whitespace-nowrap">
                        PRODUTOS <i class="fas fa-chevron-down text-[9px]"></i>
                    </a>
                    @if($headerProducts->isNotEmpty())
                    <div class="absolute top-full left-0 pt-1 w-48 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="bg-white shadow-2xl rounded-b-2xl rounded-t-none border border-gray-100 overflow-hidden flex flex-col">
                            @foreach($headerProducts as $prod)
                                <a href="{{ route('products.show', $prod) }}" 
                                   class="px-4 py-3 text-sm text-gray-700 hover:bg-green-50 hover:text-[#45B500] transition-colors {{ !$loop->last ? 'border-b border-gray-100' : '' }} font-semibold">
                                    {{ $prod->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Services Hover Dropdown -->
                <div class="relative group flex items-stretch">
                    <a href="{{ route('services.index') }}" class="uppercase flex items-center px-4 border-b-[3px] {{ request()->routeIs('services.*') ? 'border-white' : 'border-transparent' }} hover:border-white/60 hover:bg-white/10 transition gap-1.5 whitespace-nowrap">
                        SERVIÇOS <i class="fas fa-chevron-down text-[9px]"></i>
                    </a>
                    @if($headerServices->isNotEmpty())
                    <div class="absolute top-full left-0 pt-1 w-48 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="bg-white shadow-2xl rounded-b-2xl rounded-t-none border border-gray-100 overflow-hidden flex flex-col">
                            @foreach($headerServices as $serv)
                                <a href="{{ route('services.show', $serv) }}" 
                                   class="px-4 py-3 text-sm text-gray-700 hover:bg-green-50 hover:text-[#45B500] transition-colors {{ !$loop->last ? 'border-b border-gray-100' : '' }} font-semibold">
                                    {{ $serv->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <a href="{{ route('campaigns.index') }}" class="uppercase flex items-center px-4 border-b-[3px] {{ request()->routeIs('campaigns.*') ? 'border-white' : 'border-transparent' }} hover:border-white/60 hover:bg-white/10 transition whitespace-nowrap">OFERTAS</a>
                <a href="{{ route('stores.index') }}" class="uppercase flex items-center px-4 border-b-[3px] {{ request()->routeIs('stores.*') ? 'border-white' : 'border-transparent' }} hover:border-white/60 hover:bg-white/10 transition whitespace-nowrap">LOJAS</a>
                <a href="{{ route('contacts.index') }}" class="uppercase flex items-center px-4 border-b-[3px] {{ request()->routeIs('contacts.*') ? 'border-white' : 'border-transparent' }} hover:border-white/60 hover:bg-white/10 transition whitespace-nowrap">CONTACTOS</a>
            </div>

            <div class="flex-1"></div>

            <!-- Right: Dynamic Socials + App Button -->
            <div class="hidden md:flex items-center gap-5">
                <div class="flex items-center gap-4 text-white/80 text-base">
                    @if($settings->facebook)
                        <a href="{{ $settings->facebook }}" target="_blank" class="hover:text-white transition"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if($settings->instagram)
                        <a href="{{ $settings->instagram }}" target="_blank" class="hover:text-white transition"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if($settings->tiktok)
                        <a href="{{ $settings->tiktok }}" target="_blank" class="hover:text-white transition"><i class="fab fa-tiktok"></i></a>
                    @endif
                    @if($settings->linkedin)
                        <a href="{{ $settings->linkedin }}" target="_blank" class="hover:text-white transition"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if($settings->youtube)
                        <a href="{{ $settings->youtube }}" target="_blank" class="hover:text-white transition"><i class="fab fa-youtube"></i></a>
                    @endif
                </div>
                @if($settings->app_store || $settings->google_play)
                    <div class="flex items-center gap-3">
                        @if($settings->app_store)
                            <a href="{{ $settings->app_store }}" target="_blank" class="hover:scale-105 transition-transform duration-200">
                                <img src="{{ asset('assets/img/appstore.png') }}" alt="App Store" class="h-9 w-auto">
                            </a>
                        @endif
                        @if($settings->google_play)
                            <a href="{{ $settings->google_play }}" target="_blank" class="hover:scale-105 transition-transform duration-200">
                                <img src="{{ asset('assets/img/googleplay.png') }}" alt="Google Play" class="h-9 w-auto">
                            </a>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Mobile Toggle -->
            <button id="mobile-menu-toggle" class="md:hidden text-white p-2 focus:outline-none ml-auto">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </div>

    <!-- Row 2: Quick Nav (Smooth scroll anchors / Contextual pages) -->
    @if(!request()->routeIs('campaigns.*') && !request()->routeIs('stores.*') && !request()->routeIs('contacts.*'))
    <div class="bg-[#3a9900] w-full border-t border-white/10">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10 h-[50px] hidden md:flex items-center gap-1">
            <div class="flex items-center gap-1 text-white text-[12px] font-bold tracking-wide">
                @if(request()->routeIs('products.*'))
                    @foreach($headerProducts as $prod)
                        @php
                            $currentRouteProduct = request()->route('product');
                            $isActiveProduct = $currentRouteProduct && (
                                (is_object($currentRouteProduct) && $currentRouteProduct->slug === $prod->slug) || 
                                (is_string($currentRouteProduct) && $currentRouteProduct === $prod->slug)
                            );
                        @endphp
                        <a href="{{ route('products.show', $prod) }}" 
                           class="{{ $isActiveProduct ? 'bg-white text-[#3a9900] font-extrabold' : 'hover:bg-white/20' }} px-4 py-1.5 rounded-lg transition uppercase">
                            {{ $prod->name }}
                        </a>
                    @endforeach
                @elseif(request()->routeIs('services.*'))
                    @foreach($headerServices as $serv)
                        @php
                            $currentRouteService = request()->route('service');
                            $isActiveService = $currentRouteService && (
                                (is_object($currentRouteService) && $currentRouteService->slug === $serv->slug) || 
                                (is_string($currentRouteService) && $currentRouteService === $serv->slug)
                            );
                        @endphp
                        <a href="{{ route('services.show', $serv) }}" 
                           class="{{ $isActiveService ? 'bg-white text-[#3a9900] font-extrabold' : 'hover:bg-white/20' }} px-4 py-1.5 rounded-lg transition uppercase">
                            {{ $serv->name }}
                        </a>
                    @endforeach
                @else
                    @php
                        $isHome = request()->routeIs('home');
                        $prefix = $isHome ? '' : url('/');
                    @endphp
                    <a href="{{ $prefix }}#ofertas" class="bg-white text-[#3a9900] px-4 py-1.5 rounded-lg hover:bg-white/90 transition font-extrabold uppercase">OFERTAS ESPECIAIS</a>
                    <a href="{{ $prefix }}#receitas" class="hover:bg-white/20 px-4 py-1.5 rounded-lg transition uppercase">RECEITAS</a>
                    <a href="{{ $prefix }}#servicos" class="hover:bg-white/20 px-4 py-1.5 rounded-lg transition uppercase">NOSSOS SERVIÇOS</a>
                    <a href="{{ $prefix }}#lojas" class="hover:bg-white/20 px-4 py-1.5 rounded-lg transition uppercase">NOSSAS LOJAS</a>
                @endif
            </div>
        </div>
    </div>
    @endif
</header>
