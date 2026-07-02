<header class="sticky top-0 z-50 w-full shadow-xl">
    <!-- Row 1: Logo + Main Nav + App -->
    <div class="bg-[#45B500] w-full">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10 h-[76px] flex items-center gap-6">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex-shrink-0">
                <img src="{{ asset('assets/img/logo-white.png') }}" alt="FRESMART" class="h-14 w-auto">
            </a>

            <!-- Desktop Nav Links -->
            <div class="hidden md:flex items-stretch h-full font-bold text-white text-[13px] tracking-wide">
                <a href="{{ route('home') }}" class="uppercase flex items-center px-4 border-b-[3px] border-white whitespace-nowrap">INÍCIO</a>
                
                <!-- Services Hover Dropdown -->
                <div class="relative group flex items-stretch">
                    <a href="{{ route('services.index') }}" class="uppercase flex items-center px-4 border-b-[3px] border-transparent hover:border-white/60 hover:bg-white/10 transition gap-1.5 whitespace-nowrap">
                        SERVIÇOS <i class="fas fa-chevron-down text-[9px]"></i>
                    </a>
                    @php
                        $headerServices = \App\Models\Service::orderBy('created_at', 'asc')->get();
                    @endphp
                    @if($headerServices->isNotEmpty())
                    <div class="absolute top-full left-0 pt-1 w-48 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="bg-white shadow-2xl rounded-xl border border-gray-100 overflow-hidden flex flex-col">
                            @foreach($headerServices as $serv)
                                <a href="{{ route('services.index') }}#{{ $serv->slug }}" 
                                   class="px-4 py-3 text-sm text-gray-700 hover:bg-green-50 hover:text-[#45B500] transition-colors {{ !$loop->last ? 'border-b border-gray-100' : '' }} font-semibold">
                                    {{ $serv->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <a href="{{ route('campaigns.index') }}" class="uppercase flex items-center px-4 border-b-[3px] border-transparent hover:border-white/60 hover:bg-white/10 transition whitespace-nowrap">OFERTAS</a>
                <a href="{{ route('stores.index') }}" class="uppercase flex items-center px-4 border-b-[3px] border-transparent hover:border-white/60 hover:bg-white/10 transition whitespace-nowrap">LOJAS</a>
                <a href="{{ route('about.index') }}" class="uppercase flex items-center px-4 border-b-[3px] border-transparent hover:border-white/60 hover:bg-white/10 transition whitespace-nowrap">QUEM SOMOS</a>
                <a href="{{ route('contacts.index') }}" class="uppercase flex items-center px-4 border-b-[3px] border-transparent hover:border-white/60 hover:bg-white/10 transition whitespace-nowrap">CONTACTOS</a>
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
                    <a href="{{ $settings->app_store ?: $settings->google_play }}" target="_blank" 
                       class="bg-white hover:bg-white/90 text-[#45B500] font-bold px-6 py-2.5 rounded-xl transition-colors whitespace-nowrap shadow-sm uppercase tracking-wide text-sm">
                        Baixar App
                    </a>
                @endif
            </div>

            <!-- Mobile Toggle -->
            <button id="mobile-menu-toggle" class="md:hidden text-white p-2 focus:outline-none ml-auto">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </div>

    <!-- Row 2: Quick Nav (Smooth scroll anchors) -->
    @php
        $isHome = request()->routeIs('home');
        $prefix = $isHome ? '' : url('/');
    @endphp
    <div class="bg-[#3a9900] w-full border-t border-white/10">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10 h-[50px] hidden md:flex items-center gap-1">
            <div class="flex items-center gap-1 text-white text-[12px] font-bold tracking-wide">
                <a href="{{ $prefix }}#ofertas" class="bg-white text-[#3a9900] px-4 py-1.5 rounded-lg hover:bg-white/90 transition font-extrabold uppercase">OFERTAS ESPECIAIS</a>
                <a href="{{ $prefix }}#receitas" class="hover:bg-white/20 px-4 py-1.5 rounded-lg transition uppercase">RECEITAS</a>
                <a href="{{ $prefix }}#servicos" class="hover:bg-white/20 px-4 py-1.5 rounded-lg transition uppercase">NOSSOS SERVIÇOS</a>
                <a href="{{ $prefix }}#lojas" class="hover:bg-white/20 px-4 py-1.5 rounded-lg transition uppercase">NOSSAS LOJAS</a>
            </div>
        </div>
    </div>
</header>
