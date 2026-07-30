<x-frontend.layout>
    <x-slot:head_scripts>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
        <style>
            #home-stores-map {
                height: 100%;
                width: 100%;
                position: relative;
                z-index: 1;
            }

            .leaflet-popup-content-wrapper {
                border-radius: 16px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
                border: 1px solid rgba(0, 0, 0, 0.05);
            }

            .leaflet-popup-content {
                margin: 12px;
            }

            .custom-scrollbar::-webkit-scrollbar {
                width: 6px;
            }

            .custom-scrollbar::-webkit-scrollbar-track {
                background: transparent;
            }

            .custom-scrollbar::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 3px;
            }

            .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }

            .truncate-2-lines {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        </style>
    </x-slot>

    <!-- Hero Slider Section - DESKTOP (Dinâmico com Aspect Ratio Responsivo) -->
    <div class="hidden sm:block w-full bg-white border-b border-gray-100">
        <header id="hero-slider-desktop"
            class="relative w-full aspect-[1920/460] overflow-hidden transition-all duration-300">
            @forelse($slides as $index => $slide)
                @php
                    $imgPath = $slide->image ?: $slide->image_path;
                    $slideSrc = $imgPath ? (str_starts_with($imgPath, 'http') ? $imgPath : (str_starts_with($imgPath, 'uploads/') ? asset($imgPath) : asset('storage/' . $imgPath))) : asset('assets/img/slider1.png');
                    $slideLink = $slide->link ?: $slide->link_url;
                @endphp
                <div
                    class="desktop-slide absolute inset-0 w-full h-full transition-opacity duration-700 ease-in-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}">
                    @if ($slideLink)
                        <a href="{{ $slideLink }}" class="block w-full h-full">
                    @endif
                    <img src="{{ $slideSrc }}"
                        alt="{{ $slide->title ?: 'Fresmart Banner' }}" class="w-full h-full object-contain sm:object-cover">
                    @if ($slide->title || $slide->subtitle)
                        <div class="absolute inset-0 bg-black/20 flex flex-col justify-end p-8 md:p-12 text-white">
                            @if ($slide->title)
                                <h2 class="text-2xl md:text-4xl font-black uppercase tracking-tight drop-shadow-md">
                                    {{ $slide->title }}</h2>
                            @endif
                            @if ($slide->subtitle)
                                <p class="text-sm md:text-base mt-2 drop-shadow font-medium max-w-2xl">
                                    {{ $slide->subtitle }}</p>
                            @endif
                        </div>
                    @endif
                    @if ($slideLink)
                        </a>
                    @endif
                </div>
            @empty
                <!-- Fallback se não houver slides cadastrados -->
                <div class="w-full h-full relative">
                    <img src="{{ asset('assets/img/slider1.png') }}" class="w-full h-full object-cover">
                </div>
            @endforelse
        </header>

        <!-- Indicators/Dots (Por Baixo do Banner Principal com Maior Afastamento) -->
        @if ($slides->count() > 1)
            <div class="flex justify-center gap-2.5 py-4 bg-white border-t border-gray-50">
                @foreach ($slides as $index => $slide)
                    <button
                        class="desktop-slider-dot h-2.5 rounded-full transition-all duration-300 cursor-pointer {{ $index === 0 ? 'bg-[#45B500] w-6' : 'bg-gray-300 w-2.5' }}"
                        aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Hero Slider Section - MOBILE (Layout ajustado para manter banner idêntico) -->
    <div class="block sm:hidden w-full bg-white py-4 border-b border-gray-100">
        <header id="hero-slider-mobile" class="relative w-full overflow-hidden">
            <div id="mobile-slider-track" class="flex transition-transform duration-500 ease-out"
                style="transform: translateX(6.5vw);">
                @forelse($slides as $slide)
                    @php
                        $imgPath = $slide->image ?: $slide->image_path;
                        $slideSrc = $imgPath ? (str_starts_with($imgPath, 'http') ? $imgPath : (str_starts_with($imgPath, 'uploads/') ? asset($imgPath) : asset('storage/' . $imgPath))) : asset('assets/img/slider1.png');
                        $slideLink = $slide->link ?: $slide->link_url;
                    @endphp
                    <div class="mobile-slide flex-shrink-0 w-[82vw] mr-[5vw] last:mr-0">
                        <div
                            class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm aspect-[1920/540] relative">
                            @if ($slideLink)
                                <a href="{{ $slideLink }}" class="block w-full h-full">
                            @endif
                            <img src="{{ $slideSrc }}"
                                alt="{{ $slide->title ?: 'Fresmart Mobile Banner' }}"
                                class="w-full h-full object-cover">
                            @if ($slide->title || $slide->subtitle)
                                <div class="absolute inset-0 bg-black/20 flex flex-col justify-end p-4 text-white">
                                    @if ($slide->title)
                                        <h2 class="text-base font-black uppercase tracking-tight drop-shadow-md">
                                            {{ $slide->title }}</h2>
                                    @endif
                                    @if ($slide->subtitle)
                                        <p class="text-xs mt-1 drop-shadow font-medium line-clamp-2">
                                            {{ $slide->subtitle }}</p>
                                    @endif
                                </div>
                            @endif
                            @if ($slideLink)
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="mobile-slide flex-shrink-0 w-[82vw]">
                        <div
                            class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm aspect-[1920/540]">
                            <img src="{{ asset('assets/img/slider1.png') }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Mobile Dots -->
            @if ($slides->count() > 1)
                <div class="flex justify-center gap-2 mt-4">
                    @foreach ($slides as $index => $slide)
                        <button
                            class="mobile-slider-dot h-2.5 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-[#45B500] w-6' : 'bg-gray-300 w-2.5' }}"
                            aria-label="Slide Mobile {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            @endif
        </header>
    </div>

    <!-- Campanhas (Banners Promocionais em Grid de 12 Colunas) -->
    <section id="ofertas" class="py-16 bg-[#f8f9fa] w-full border-t border-gray-100">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
            <h2 class="text-3xl font-bold text-gray-900 uppercase tracking-tight mb-10">Campanhas em Destaque</h2>

            @if($campaigns->count() > 0)
                @php $cList = $campaigns->values(); @endphp
                @if($cList->count() >= 5)
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-5 md:auto-rows-[240px]">
                        <!-- Item 0: col-span-5 row-span-2 -->
                        <a href="{{ $cList[0]->link ?: route('campaigns.show', $cList[0]) }}"
                            class="md:col-start-1 md:col-span-5 md:row-start-1 md:row-span-2 rounded-[20px] overflow-hidden relative group bg-white shadow-sm hover:shadow-xl transition-all duration-300 min-h-[300px] md:min-h-0">
                            <img src="{{ $cList[0]->image ? asset(str_starts_with($cList[0]->image, 'uploads/') ? $cList[0]->image : 'storage/'.$cList[0]->image) : asset('assets/img/hero.png') }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                alt="{{ $cList[0]->title }}">

                            @if(($cList[0]->show_title ?? true) || ($cList[0]->show_button ?? true))
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent opacity-80 group-hover:opacity-100 transition-opacity"></div>

                                <div class="absolute bottom-6 left-6 right-6">
                                    @if($cList[0]->show_title ?? true)
                                        <h3 class="text-xl md:text-2xl font-bold text-white drop-shadow-md leading-tight">
                                            {{ $cList[0]->title }}
                                        </h3>
                                    @endif

                                    @if($cList[0]->show_button ?? true)
                                        <div class="mt-3 overflow-hidden">
                                            <span class="inline-block bg-white text-gray-900 text-[13px] font-bold px-5 py-2.5 rounded-full shadow-sm transform translate-y-0 opacity-100 transition-all duration-300 group-hover:-translate-y-1 group-hover:bg-[#45B500] group-hover:text-white">
                                                Ver Oferta
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </a>

                        <!-- Item 1: col-span-4 row-span-1 -->
                        <a href="{{ $cList[1]->link ?: route('campaigns.show', $cList[1]) }}"
                            class="md:col-start-6 md:col-span-4 md:row-start-1 md:row-span-1 rounded-[20px] overflow-hidden relative group bg-white shadow-sm hover:shadow-xl transition-all duration-300 min-h-[220px] md:min-h-0">
                            <img src="{{ $cList[1]->image ? asset(str_starts_with($cList[1]->image, 'uploads/') ? $cList[1]->image : 'storage/'.$cList[1]->image) : asset('assets/img/hero.png') }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                alt="{{ $cList[1]->title }}">

                            @if(($cList[1]->show_title ?? true) || ($cList[1]->show_button ?? true))
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent opacity-80 group-hover:opacity-100 transition-opacity"></div>

                                <div class="absolute bottom-6 left-6 right-6">
                                    @if($cList[1]->show_title ?? true)
                                        <h3 class="text-xl md:text-2xl font-bold text-white drop-shadow-md leading-tight">
                                            {{ $cList[1]->title }}
                                        </h3>
                                    @endif

                                    @if($cList[1]->show_button ?? true)
                                        <div class="mt-3 overflow-hidden">
                                            <span class="inline-block bg-white text-gray-900 text-[13px] font-bold px-5 py-2.5 rounded-full shadow-sm transform translate-y-0 opacity-100 transition-all duration-300 group-hover:-translate-y-1 group-hover:bg-[#45B500] group-hover:text-white">
                                                Ver Oferta
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </a>

                        <!-- Item 2: col-span-2 row-span-1 -->
                        <a href="{{ $cList[2]->link ?: route('campaigns.show', $cList[2]) }}"
                            class="md:col-start-6 md:col-span-2 md:row-start-2 md:row-span-1 rounded-[20px] overflow-hidden relative group bg-white shadow-sm hover:shadow-xl transition-all duration-300 min-h-[220px] md:min-h-0">
                            <img src="{{ $cList[2]->image ? asset(str_starts_with($cList[2]->image, 'uploads/') ? $cList[2]->image : 'storage/'.$cList[2]->image) : asset('assets/img/hero.png') }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                alt="{{ $cList[2]->title }}">

                            @if(($cList[2]->show_title ?? true) || ($cList[2]->show_button ?? true))
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent opacity-80 group-hover:opacity-100 transition-opacity"></div>

                                <div class="absolute bottom-6 left-6 right-6">
                                    @if($cList[2]->show_title ?? true)
                                        <h3 class="text-xl md:text-2xl font-bold text-white drop-shadow-md leading-tight">
                                            {{ $cList[2]->title }}
                                        </h3>
                                    @endif

                                    @if($cList[2]->show_button ?? true)
                                        <div class="mt-3 overflow-hidden">
                                            <span class="inline-block bg-white text-gray-900 text-[13px] font-bold px-5 py-2.5 rounded-full shadow-sm transform translate-y-0 opacity-100 transition-all duration-300 group-hover:-translate-y-1 group-hover:bg-[#45B500] group-hover:text-white">
                                                Ver Oferta
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </a>

                        <!-- Item 3: col-span-2 row-span-1 -->
                        <a href="{{ $cList[3]->link ?: route('campaigns.show', $cList[3]) }}"
                            class="md:col-start-8 md:col-span-2 md:row-start-2 md:row-span-1 rounded-[20px] overflow-hidden relative group bg-white shadow-sm hover:shadow-xl transition-all duration-300 min-h-[220px] md:min-h-0">
                            <img src="{{ $cList[3]->image ? asset(str_starts_with($cList[3]->image, 'uploads/') ? $cList[3]->image : 'storage/'.$cList[3]->image) : asset('assets/img/hero.png') }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                alt="{{ $cList[3]->title }}">

                            @if(($cList[3]->show_title ?? true) || ($cList[3]->show_button ?? true))
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent opacity-80 group-hover:opacity-100 transition-opacity"></div>

                                <div class="absolute bottom-6 left-6 right-6">
                                    @if($cList[3]->show_title ?? true)
                                        <h3 class="text-xl md:text-2xl font-bold text-white drop-shadow-md leading-tight">
                                            {{ $cList[3]->title }}
                                        </h3>
                                    @endif

                                    @if($cList[3]->show_button ?? true)
                                        <div class="mt-3 overflow-hidden">
                                            <span class="inline-block bg-white text-gray-900 text-[13px] font-bold px-5 py-2.5 rounded-full shadow-sm transform translate-y-0 opacity-100 transition-all duration-300 group-hover:-translate-y-1 group-hover:bg-[#45B500] group-hover:text-white">
                                                Ver Oferta
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </a>

                        <!-- Item 4: col-span-3 row-span-2 -->
                        <a href="{{ $cList[4]->link ?: route('campaigns.show', $cList[4]) }}"
                            class="md:col-start-10 md:col-span-3 md:row-start-1 md:row-span-2 rounded-[20px] overflow-hidden relative group bg-white shadow-sm hover:shadow-xl transition-all duration-300 min-h-[300px] md:min-h-0">
                            <img src="{{ $cList[4]->image ? asset(str_starts_with($cList[4]->image, 'uploads/') ? $cList[4]->image : 'storage/'.$cList[4]->image) : asset('assets/img/hero.png') }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                alt="{{ $cList[4]->title }}">

                            @if(($cList[4]->show_title ?? true) || ($cList[4]->show_button ?? true))
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent opacity-80 group-hover:opacity-100 transition-opacity"></div>

                                <div class="absolute bottom-6 left-6 right-6">
                                    @if($cList[4]->show_title ?? true)
                                        <h3 class="text-xl md:text-2xl font-bold text-white drop-shadow-md leading-tight">
                                            {{ $cList[4]->title }}
                                        </h3>
                                    @endif

                                    @if($cList[4]->show_button ?? true)
                                        <div class="mt-3 overflow-hidden">
                                            <span class="inline-block bg-white text-gray-900 text-[13px] font-bold px-5 py-2.5 rounded-full shadow-sm transform translate-y-0 opacity-100 transition-all duration-300 group-hover:-translate-y-1 group-hover:bg-[#45B500] group-hover:text-white">
                                                Ver Oferta
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </a>
                    </div>

                    <!-- Se houver mais de 5 campanhas, exibe as restantes num grid de 3 colunas abaixo -->
                    @if($cList->count() > 5)
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-6">
                            @foreach($cList->slice(5) as $extraCampaign)
                                <a href="{{ $extraCampaign->link ?: route('campaigns.show', $extraCampaign) }}"
                                    class="rounded-[20px] overflow-hidden relative group bg-white shadow-sm hover:shadow-xl transition-all duration-300 h-[240px]">
                                    <img src="{{ $extraCampaign->image ? asset(str_starts_with($extraCampaign->image, 'uploads/') ? $extraCampaign->image : 'storage/'.$extraCampaign->image) : asset('assets/img/hero.png') }}"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                        alt="{{ $extraCampaign->title }}">
                                    @if(($extraCampaign->show_title ?? true) || ($extraCampaign->show_button ?? true))
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent opacity-80 group-hover:opacity-100 transition-opacity"></div>
                                        <div class="absolute bottom-6 left-6 right-6">
                                            @if($extraCampaign->show_title ?? true)
                                                <h3 class="text-xl font-bold text-white drop-shadow-md leading-tight">
                                                    {{ $extraCampaign->title }}
                                                </h3>
                                            @endif
                                            @if($extraCampaign->show_button ?? true)
                                                <div class="mt-3 overflow-hidden">
                                                    <span class="inline-block bg-white text-gray-900 text-[13px] font-bold px-5 py-2.5 rounded-full shadow-sm transform translate-y-0 opacity-100 transition-all duration-300 group-hover:-translate-y-1 group-hover:bg-[#45B500] group-hover:text-white">
                                                        Ver Oferta
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @endif
                @else
                    <!-- Fallback para menos de 5 campanhas -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        @foreach($cList as $campaign)
                            <a href="{{ $campaign->link ?: route('campaigns.show', $campaign) }}"
                                class="rounded-[20px] overflow-hidden relative group bg-white shadow-sm hover:shadow-xl transition-all duration-300 h-[260px]">
                                <img src="{{ $campaign->image ? asset(str_starts_with($campaign->image, 'uploads/') ? $campaign->image : 'storage/'.$campaign->image) : asset('assets/img/hero.png') }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    alt="{{ $campaign->title }}">
                                @if(($campaign->show_title ?? true) || ($campaign->show_button ?? true))
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent opacity-80 group-hover:opacity-100 transition-opacity"></div>
                                    <div class="absolute bottom-6 left-6 right-6">
                                        @if($campaign->show_title ?? true)
                                            <h3 class="text-xl font-bold text-white drop-shadow-md leading-tight">
                                                {{ $campaign->title }}
                                            </h3>
                                        @endif
                                        @if($campaign->show_button ?? true)
                                            <div class="mt-3 overflow-hidden">
                                                <span class="inline-block bg-white text-gray-900 text-[13px] font-bold px-5 py-2.5 rounded-full shadow-sm transform translate-y-0 opacity-100 transition-all duration-300 group-hover:-translate-y-1 group-hover:bg-[#45B500] group-hover:text-white">
                                                    Ver Oferta
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif
            @else
                <p class="text-gray-500">Nenhuma campanha ativa de momento.</p>
            @endif
        </div>
    </section>

    <!-- Receitas (Dinâmico com Animação) -->
    <section class="py-16 bg-white w-full border-t border-gray-50">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
            <h2 id="receitas"
                class="text-3xl font-bold text-gray-900 uppercase tracking-tight mb-12 animate-on-scroll">Receitas</h2>

            <div class="overflow-x-auto overflow-y-visible no-scrollbar -mx-4 px-4 md:mx-0 md:px-0 pb-4">
                <div class="flex flex-nowrap gap-6 pt-3 pb-4 scroll-smooth items-stretch">
                    @forelse($recipes as $recipe)
                        <div class="w-[300px] flex-shrink-0 flex animate-on-scroll">
                            <div class="w-full">
                                <x-frontend.card-recipe :recipe="$recipe" />
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">Nenhuma receita publicada ainda. Adicione via CMS!</p>
                    @endforelse
                </div>
            </div>

            <div class="mt-8 text-right">
                <a href="{{ route('recipes.index') }}"
                    class="text-sm font-bold text-[#45B500] hover:underline uppercase tracking-wider">Ver todas as
                    receitas &rarr;</a>
            </div>
    </section>

    <!-- Serviços (Dinâmico) -->
    <section id="servicos" class="py-16 w-full bg-[#f8f9fa] border-t border-gray-100">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
            <h2 id="servicos" class="text-3xl font-bold text-gray-900 uppercase tracking-tight mb-8 animate-on-scroll">
                Nossos serviços</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($services as $service)
                    <x-frontend.card-service :service="$service" />
                @empty
                    <p class="text-gray-500 col-span-3">Nenhum serviço publicado ainda.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Encontre nas Lojas (Mapa Dinâmico Completo) -->
    <section id="lojas" class="py-12 bg-white w-full border-t border-gray-50">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                <!-- Left Column (50%): Title & Text -->
                <div class="space-y-6">
                    <h2
                        class="text-3xl font-bold text-gray-900 uppercase tracking-tight mb-8 animate-on-scroll visible">
                        Nossas Lojas
                    </h2>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                        Encontre a loja Fresmart mais próxima de si, consulte os horários, contactos e serviços
                        disponíveis.
                    </p>
                    <p class="text-gray-500 text-xs md:text-sm leading-relaxed">
                        Visite-nos numa das nossas localizações espalhadas por Angola. Clique nos marcadores no mapa
                        para saber o endereço, horários, telefone e serviços associados a cada loja (como Talho, Padaria
                        e Café).
                    </p>
                    <div class="pt-4">
                        <a href="{{ route('stores.index') }}"
                            class="inline-block bg-[#45B500] hover:bg-[#3a9900] text-white font-bold py-3 px-8 rounded-2xl transition-all duration-300 shadow-md text-xs sm:text-sm uppercase tracking-wider">
                            Ver todas as lojas
                        </a>
                    </div>
                </div>

                <!-- Right Column (50%): The Map -->
                <div
                    class="w-full h-[380px] sm:h-[450px] md:h-[500px] rounded-[32px] overflow-hidden shadow-lg border border-gray-100 z-10 relative">
                    <div id="home-stores-map" class="w-full h-full"></div>
                </div>

            </div>
        </div>
    </section>

    <!-- Nova Secção Promocional (bg-[#f8f9fa] full width - Exibida Apenas Se Houver Imagem Carregada) -->
    @if ($page && $page->section_image_1)
        <section class="py-10 bg-[#f8f9fa] w-full border-t border-gray-100">
            <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
                @php
                    $bannerImage = asset($page->section_image_1);
                    $bannerUrl = $page->extra_content_1 ? $page->extra_content_1 : route('contacts.index');
                @endphp

                <a href="{{ $bannerUrl }}"
                    class="block w-full aspect-[16/3] rounded-2xl md:rounded-[32px] overflow-hidden transition-transform duration-300 hover:scale-[1.005]">
                    <img src="{{ $bannerImage }}" alt="Promoção Fresmart"
                        class="w-full h-full object-cover border border-gray-100 shadow-sm rounded-2xl md:rounded-[32px]">
                </a>
            </div>
        </section>
    @endif

    <x-slot:scripts>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
        <script>
            // Lógica do Hero Slider - Desktop
            (function() {
                const slides = document.querySelectorAll('.desktop-slide');
                const dots = document.querySelectorAll('.desktop-slider-dot');
                let currentSlide = 0;
                const totalSlides = slides.length;

                function showSlide(index) {
                    slides.forEach((slide, i) => {
                        if (i === index) {
                            slide.classList.remove('opacity-0');
                            slide.classList.add('opacity-100');
                            slide.style.zIndex = '10';
                        } else {
                            slide.classList.remove('opacity-100');
                            slide.classList.add('opacity-0');
                            slide.style.zIndex = '0';
                        }
                    });
                    dots.forEach((dot, i) => {
                        if (i === index) {
                            dot.classList.remove('bg-gray-300', 'w-2.5');
                            dot.classList.add('bg-[#45B500]', 'w-6');
                        } else {
                            dot.classList.remove('bg-[#45B500]', 'w-6');
                            dot.classList.add('bg-gray-300', 'w-2.5');
                        }
                    });
                    currentSlide = index;
                }

                if (totalSlides > 1) {
                    setInterval(() => {
                        let next = (currentSlide + 1) % totalSlides;
                        showSlide(next);
                    }, 5000);

                    dots.forEach((dot, index) => {
                        dot.addEventListener('click', () => {
                            showSlide(index);
                        });
                    });
                }
            })();

            // Lógica do Hero Slider - Mobile (Card Carousel)
            (function() {
                const track = document.getElementById('mobile-slider-track');
                const dots = document.querySelectorAll('.mobile-slider-dot');
                let currentSlide = 0;
                const totalSlides = dots.length;

                function showMobileSlide(index) {
                    if (!track) return;

                    // Center calculation: 6.5vw is center offset, 87vw is slide step (82vw card + 5vw total gap)
                    track.style.transform = `translateX(calc(6.5vw - (${index} * 87vw)))`;

                    dots.forEach((dot, i) => {
                        if (i === index) {
                            dot.classList.remove('bg-gray-300', 'w-2.5');
                            dot.classList.add('bg-[#45B500]', 'w-6');
                        } else {
                            dot.classList.remove('bg-[#45B500]', 'w-6');
                            dot.classList.add('bg-gray-300', 'w-2.5');
                        }
                    });
                    currentSlide = index;
                }

                if (totalSlides > 1 && track) {
                    setInterval(() => {
                        let next = (currentSlide + 1) % totalSlides;
                        showMobileSlide(next);
                    }, 5000);

                    dots.forEach((dot, index) => {
                        dot.addEventListener('click', () => {
                            showMobileSlide(index);
                        });
                    });

                    // Add simple touch swipe support
                    let startX = 0;
                    let endX = 0;

                    track.addEventListener('touchstart', (e) => {
                        startX = e.touches[0].clientX;
                    }, {
                        passive: true
                    });

                    track.addEventListener('touchend', (e) => {
                        endX = e.changedTouches[0].clientX;
                        let diff = startX - endX;
                        if (Math.abs(diff) > 50) {
                            if (diff > 0) {
                                // Swipe left -> next
                                showMobileSlide((currentSlide + 1) % totalSlides);
                            } else {
                                // Swipe right -> prev
                                showMobileSlide((currentSlide - 1 + totalSlides) % totalSlides);
                            }
                        }
                    }, {
                        passive: true
                    });
                }
            })();

            // Lógica do Localizador de Lojas Completo
            var map;
            var mapMarkers = {};
            var storesData = @json($stores);
            var activeCardId = null;

            document.addEventListener('DOMContentLoaded', function() {
                // Initialize map centered generally on Angola/Luanda, fits bounds dynamically
                map = L.map('home-stores-map', {
                    zoomControl: false,
                    scrollWheelZoom: false
                }).setView([-8.9, 13.2], 12); // default zoom closer (12 instead of 10)

                L.control.zoom({
                    position: 'topright'
                }).addTo(map);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 18,
                    attribution: '&copy; OpenStreetMap'
                }).addTo(map);

                // Define Custom Green Marker Pin Icon
                var customIcon = L.divIcon({
                    html: `
                    <div class="relative flex items-center justify-center pointer-events-auto">
                        <!-- Pin Outer ring -->
                        <div class="w-9 h-9 rounded-full bg-[#45B500] border-[3px] border-white shadow-lg flex items-center justify-center hover:scale-110 transition-transform duration-200">
                            <i class="fas fa-shopping-cart text-white text-[11px]"></i>
                        </div>
                        <!-- Small pointer triangle -->
                        <div class="absolute bottom-[-5px] left-1/2 -translate-x-1/2 w-0 h-0 border-l-[4px] border-l-transparent border-r-[4px] border-r-transparent border-t-[6px] border-t-[#45B500]"></div>
                    </div>
                `,
                    iconSize: [36, 41],
                    iconAnchor: [18, 41],
                    popupAnchor: [0, -41],
                    className: 'custom-store-marker'
                });

                // Populate Markers
                storesData.forEach(function(store) {
                    if (store.lat && store.lng) {
                        var marker = L.marker([parseFloat(store.lat), parseFloat(store.lng)], {
                                icon: customIcon
                            })
                            .addTo(map)
                            .bindPopup(createPopupHtml(store));

                        // Sync marker click to select card
                        marker.on('click', function() {
                            selectStore(store.id, false);
                            scrollToCard(store.id);
                        });

                        mapMarkers[store.id] = marker;
                    }
                });

                // Setup Search and Filters
                document.getElementById('search-input').addEventListener('input', applyFilters);
                document.getElementById('city-filter').addEventListener('change', applyFilters);
                document.getElementById('open-now-filter').addEventListener('change', applyFilters);

                // Try Geolocation distance calculation
                initGeolocation();
            });

            // HTML Creator for Map Popups
            function createPopupHtml(store) {
                var imgHtml = '';
                if (store.image) {
                    var imgPath = store.image.startsWith('uploads/') ? store.image : 'storage/' + store.image;
                    imgHtml =
                        `<img src="${window.location.origin}/${imgPath}" class="w-full h-24 object-cover rounded-lg mb-2 border border-gray-100">`;
                } else {
                    imgHtml =
                        `<img src="${window.location.origin}/assets/img/loja.png" class="w-full h-24 object-cover rounded-lg mb-2 border border-gray-100">`;
                }

                var badgeClass = 'bg-red-100 text-red-700';
                if (store.status_label.color === 'green') {
                    badgeClass = 'bg-green-100 text-green-700';
                } else if (store.status_label.color === 'yellow') {
                    badgeClass = 'bg-yellow-100 text-yellow-700';
                }

                return `
                    <div class="map-store-popup p-1" style="max-width: 250px; font-family: sans-serif;">
                        ${imgHtml}
                        <div class="flex items-center justify-between gap-2 mb-2">
                            <h4 class="font-bold text-gray-900 m-0 text-sm leading-tight" style="margin: 0; font-size: 13px;">${store.name}</h4>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold ${badgeClass}">
                                ${store.status_label.label}
                            </span>
                        </div>
                        <p class="text-xs text-gray-500" style="margin: 0 0 4px; font-size: 11px; line-height: 1.3;"><i class="fas fa-map-marker-alt text-gray-400 mr-1"></i> ${store.address}</p>
                        ${store.phone ? `<p class="text-xs text-gray-500" style="margin: 0 0 6px; font-size: 11px;"><i class="fas fa-phone-alt text-gray-400 mr-1"></i> <a href="tel:${store.phone}" style="color: #45B500; text-decoration: none;">${store.phone}</a></p>` : ''}
                        <div class="flex gap-2 mt-3 pt-2 border-t border-gray-100" style="display: flex; gap: 8px;">
                            <a href="/lojas/${store.slug}" style="flex: 1; text-align: center; padding: 6px 0; font-size: 10px; font-weight: bold; color: #45B500; border: 1px solid #45B500; border-radius: 8px; text-decoration: none; cursor: pointer;">Detalhes</a>
                            <a href="https://www.google.com/maps/dir/?api=1&destination=${store.lat},${store.lng}" target="_blank" style="flex: 1; text-align: center; padding: 6px 0; font-size: 10px; font-weight: bold; color: white; background: #45B500; border-radius: 8px; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 4px; cursor: pointer;">Como Chegar</a>
                        </div>
                    </div>
                `;
            }

            // Select store card and sync with map
            function selectStore(storeId, centerMap) {
                // Remove active classes from all cards
                var cards = document.querySelectorAll('.store-card');
                cards.forEach(function(card) {
                    card.classList.remove('border-[#45B500]', 'bg-green-50/20', 'shadow-md', 'ring-2',
                        'ring-[#45B500]/10');
                    card.classList.add('border-gray-100', 'shadow-sm');
                });

                // Add active classes to selected card
                var selectedCard = document.getElementById(`store-card-${storeId}`);
                if (selectedCard) {
                    selectedCard.classList.remove('border-gray-100', 'shadow-sm');
                    selectedCard.classList.add('border-[#45B500]', 'bg-green-50/20', 'shadow-md', 'ring-2',
                        'ring-[#45B500]/10');
                    activeCardId = storeId;
                }

                // If marker exists, trigger popup
                var marker = mapMarkers[storeId];
                if (marker) {
                    if (centerMap) {
                        map.setView(marker.getLatLng(), 15, {
                            animate: true,
                            duration: 0.8
                        });
                    }
                    setTimeout(function() {
                        marker.openPopup();
                    }, centerMap ? 400 : 0);
                }
            }

            // Smooth scroll list to selected card
            function scrollToCard(storeId) {
                var card = document.getElementById(`store-card-${storeId}`);
                var listContainer = document.getElementById('store-list-container');
                if (card && listContainer) {
                    var topPos = card.offsetTop - listContainer.offsetTop;
                    listContainer.scrollTo({
                        top: topPos - 12,
                        behavior: 'smooth'
                    });
                }
            }

            // Check if store matches all active filters
            function isStoreMatch(store, query, selectedCity, openOnly) {
                if (query) {
                    var q = query.toLowerCase();
                    var matchName = store.name ? store.name.toLowerCase().includes(q) : false;
                    var matchAddr = store.address ? store.address.toLowerCase().includes(q) : false;
                    var matchBairro = store.bairro ? store.bairro.toLowerCase().includes(q) : false;
                    var matchCity = store.city ? store.city.toLowerCase().includes(q) : false;
                    if (!matchName && !matchAddr && !matchBairro && !matchCity) return false;
                }
                if (selectedCity && store.city !== selectedCity) return false;
                if (openOnly && !store.is_open) return false;
                return true;
            }

            // Apply all filters and update view
            function applyFilters() {
                var query = document.getElementById('search-input').value.trim();
                var selectedCity = document.getElementById('city-filter').value;
                var openOnly = document.getElementById('open-now-filter').checked;

                var visibleCount = 0;
                storesData.forEach(function(store) {
                    var card = document.getElementById(`store-card-${store.id}`);
                    var marker = mapMarkers[store.id];
                    var match = isStoreMatch(store, query, selectedCity, openOnly);

                    if (match) {
                        if (card) card.style.display = 'block';
                        if (marker) map.addLayer(marker);
                        visibleCount++;
                    } else {
                        if (card) card.style.display = 'none';
                        if (marker) map.removeLayer(marker);
                    }
                });

                var noResults = document.getElementById('no-results-msg');
                if (noResults) {
                    noResults.style.display = (visibleCount === 0) ? 'block' : 'none';
                }
            }

            // Optional: User Geolocation to sort stores by distance
            function initGeolocation() {
                if ('geolocation' in navigator) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var userLat = position.coords.latitude;
                        var userLng = position.coords.longitude;

                        // Calculate distance to each store using Haversine formula
                        storesData.forEach(function(store) {
                            if (store.lat && store.lng) {
                                store.distance = calculateDistance(userLat, userLng, parseFloat(store
                                    .lat), parseFloat(store.lng));
                                var distEl = document.getElementById(`store-distance-${store.id}`);
                                if (distEl) {
                                    distEl.textContent = `${store.distance.toFixed(1)} km de si`;
                                    distEl.classList.remove('hidden');
                                }
                            }
                        });
                    }, function(error) {
                        // Silent fallback if permission denied or error
                    });
                }
            }

            // Haversine distance formula in kilometers
            function calculateDistance(lat1, lon1, lat2, lon2) {
                var R = 6371; // Radius of earth in km
                var dLat = (lat2 - lat1) * Math.PI / 180;
                var dLon = (lon2 - lon1) * Math.PI / 180;
                var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                    Math.sin(dLon / 2) * Math.sin(dLon / 2);
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                return R * c;
            }
        </script>
    </x-slot:scripts>
</x-frontend.layout>
