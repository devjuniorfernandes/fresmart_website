<x-frontend.layout>
    <x-slot:head_scripts>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
        <style>
            #home-stores-map {
                height: 425px;
                width: 100%;
                position: relative;
                z-index: 0;
            }

            #home-stores-map .leaflet-pane,
            #home-stores-map .leaflet-top,
            #home-stores-map .leaflet-bottom {
                z-index: 1;
            }

            #home-stores-map .leaflet-control {
                z-index: 2;
            }

            .leaflet-popup-content-wrapper {
                border-radius: 12px;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            }

            .leaflet-popup-content {
                margin: 14px 18px;
            }

            .map-store-popup h4 {
                font-weight: 700;
                color: #1a1a1a;
                margin: 0 0 4px;
                font-size: 14px;
            }

            .map-store-popup p {
                color: #6b7280;
                font-size: 12px;
                margin: 0;
            }

            .map-store-popup a {
                display: inline-block;
                margin-top: 8px;
                font-size: 12px;
                font-weight: 600;
                color: #3A9900;
                text-decoration: none;
            }

            .map-store-popup a:hover {
                text-decoration: underline;
            }
        </style>
    </x-slot>

    <!-- Hero Slider Section (Dinâmico) -->
    <header id="hero-slider"
        class="relative h-[500px] md:h-[600px] text-white flex items-center overflow-hidden w-full bg-gray-900">

        @forelse($slides as $index => $slide)
            <div
                class="slide absolute inset-0 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }} transition-opacity duration-1000 z-10">
                <div class="absolute inset-0 z-0">
                    <img src="{{ asset(str_starts_with($slide->image, 'uploads/') ? $slide->image : 'storage/' . $slide->image) }}"
                        alt="{{ $slide->title ?? 'Banner' }}" class="w-full h-full object-cover object-top">
                    @if (trim($slide->title) || trim($slide->subtitle))
                        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>
                    @endif
                </div>
                @if (trim($slide->title) || trim($slide->subtitle) || $slide->link)
                    <div class="hero-content h-full w-full flex flex-col justify-center relative z-10">
                        <div class="max-w-[1528px] mx-auto px-6 lg:px-10 w-full">
                            <div class="md:w-1/2 space-y-6">
                                @if (trim($slide->title) || trim($slide->subtitle))
                                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight leading-tight">
                                        {{ $slide->title }} @if (trim($slide->subtitle))
                                            <br> <span class="text-[#45B500]">{{ $slide->subtitle }}</span>
                                        @endif
                                    </h1>
                                @endif
                                @if ($slide->link)
                                    <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4 pt-2">
                                        <a href="{{ $slide->link }}"
                                            class="bg-[#45B500] hover:bg-white hover:text-[#1b5314] text-white transition-all duration-300 font-bold py-3 px-8 rounded-xl text-center shadow-lg hover:shadow-xl">
                                            SAIBA MAIS
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <!-- Fallback if no campaigns exist -->
            <div class="slide absolute inset-0 opacity-100 transition-opacity duration-1000 z-10">
                <div class="absolute inset-0 z-0">
                    <img src="{{ asset('assets/img/hero.png') }}" alt="FRESMART Banner 1"
                        class="w-full h-full object-cover object-top">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>
                </div>
                <div class="hero-content h-full w-full flex flex-col justify-center relative z-10">
                    <div class="max-w-[1528px] mx-auto px-6 lg:px-10 w-full">
                        <div class="md:w-1/2 space-y-6">
                            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight leading-tight">
                                SERVINDO ANGOLA<br>COM <span class="text-brand-light">CORAÇÃO</span>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse

        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-3 z-30">
            @foreach ($slides as $index => $slide)
                <button
                    class="slider-dot w-3 h-3 rounded-full {{ $index === 0 ? 'bg-white' : 'bg-white/30' }} transition-all duration-300"
                    data-index="{{ $index }}"></button>
            @endforeach
        </div>
    </header>

    <!-- Campanhas (Banners Promocionais) -->
    <section id="ofertas" class="py-16 bg-[#f8f9fa] w-full">
        <div class="w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[1528px] mx-auto">
            <h2 class="text-3xl font-bold text-gray-900 uppercase tracking-tight mb-10">Campanhas em Destaque</h2>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-5 md:auto-rows-[240px]">
                @foreach ($campaigns->take(5) as $index => $campaign)
                    @php
                        $gridClasses = 'col-span-1 row-span-1 h-[240px] md:h-auto'; // Default mobile

                        if ($index === 0) {
                            $gridClasses = 'md:col-start-1 md:col-span-5 md:row-start-1 md:row-span-2';
                        } elseif ($index === 1) {
                            $gridClasses = 'md:col-start-6 md:col-span-4 md:row-start-1 md:row-span-1';
                        } elseif ($index === 2) {
                            $gridClasses = 'md:col-start-6 md:col-span-2 md:row-start-2 md:row-span-1';
                        } elseif ($index === 3) {
                            $gridClasses = 'md:col-start-8 md:col-span-2 md:row-start-2 md:row-span-1';
                        } elseif ($index === 4) {
                            $gridClasses = 'md:col-start-10 md:col-span-3 md:row-start-1 md:row-span-2';
                        }
                    @endphp

                    <a href="{{ $campaign->link ?: route('campaigns.show', $campaign->slug ?? $campaign->id) }}"
                        class="{{ $gridClasses }} rounded-[20px] overflow-hidden relative group bg-white shadow-sm hover:shadow-xl transition-all duration-300">
                        <img src="{{ $campaign->image ? asset(str_starts_with($campaign->image, 'uploads/') ? $campaign->image : 'storage/' . $campaign->image) : asset('assets/img/hero.png') }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                            alt="{{ $campaign->title }}">

                        @if ($campaign->show_text)
                            <!-- Gradiente subtil para garantir leitura do texto -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent opacity-80 group-hover:opacity-100 transition-opacity">
                            </div>

                            <div class="absolute bottom-6 left-6 right-6">
                                <h3 class="text-xl md:text-2xl font-bold text-white drop-shadow-md leading-tight">
                                    {{ $campaign->title }}</h3>
                                <div class="mt-3 overflow-hidden">
                                    <span
                                        class="inline-block bg-white text-gray-900 text-[13px] font-bold px-5 py-2.5 rounded-full shadow-sm transform translate-y-0 opacity-100 transition-all duration-300 group-hover:-translate-y-1 group-hover:bg-[#45B500] group-hover:text-white">
                                        Ver Oferta
                                    </span>
                                </div>
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>

            @if ($campaigns->count() > 5)
                <div class="mt-10 text-center">
                    <a href="{{ route('campaigns.index') }}"
                        class="inline-block text-[#45B500] font-bold hover:underline">Ver todas as Campanhas →</a>
                </div>
            @endif
        </div>
    </section>

    <!-- Receitas Section (Dinâmico) -->
    <section id="receitas" class="py-24 bg-white w-full">
        <div class="w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[1528px] mx-auto">
            <h2 id="receitas"
                class="text-3xl font-bold text-gray-900 uppercase tracking-tight mb-12 animate-on-scroll">Receitas</h2>

            <div class="overflow-x-auto overflow-y-visible no-scrollbar -mx-4 px-4 md:mx-0 md:px-0 pb-4">
                <div class="flex flex-nowrap gap-6 pt-3 pb-4 scroll-smooth items-stretch">
                    @forelse($recipes as $recipe)
                        <div class="w-[300px] flex-shrink-0 flex">
                            <div class="w-full">
                                <x-frontend.card-recipe :recipe="$recipe" />
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Nenhuma receita publicada ainda. Adicione via CMS!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Serviços (Dinâmico) -->
    <section id="servicos" class="py-16 w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[1528px] mx-auto">
        <h2 id="servicos" class="text-3xl font-bold text-gray-900 uppercase tracking-tight mb-8 animate-on-scroll">
            Nossos serviços</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($services as $service)
                <x-frontend.card-service :service="$service" />
            @empty
                <p class="text-gray-500 col-span-3">Nenhum serviço publicado ainda.</p>
            @endforelse
        </div>
    </section>

    <!-- Encontre nas Lojas (Mapa Dinâmico) -->
    <section id="lojas" class="pb-10 pt-10 bg-white w-full overflow-hidden">
        <div
            class="w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[1528px] mx-auto flex flex-col lg:flex-row items-center gap-12 animate-on-scroll">
            <div class="lg:w-1/2 space-y-8">
                <h2 id="lojas" class="text-3xl font-bold text-gray-900 uppercase tracking-tight leading-tight">
                    Nossas Lojas</h2>
                <p class="text-gray-600 leading-relaxed text-lg md:text-xl">
                    Encontre nas lojas Fresmart, Fresmart Express e Fresmart Online uma ampla variedade de carnes,
                    frutas e legumes saudáveis que tornarão as suas receitas ainda mais completas.
                </p>
                <a href="{{ url('/lojas') }}"
                    class="btn-primary bg-[#45B500] inline-block hover:bg-[#3a9900] text-white font-bold py-4 px-12 rounded-xl text-center transition-all duration-300 text-lg">EXPLORAR
                    LOJAS</a>
            </div>
            <div class="lg:w-1/2 w-full flex justify-end">
                <div class="w-full rounded-2xl overflow-hidden relative" style="height:425px;">
                    <div id="home-stores-map"></div>
                </div>
            </div>
        </div>
    </section>

    <x-slot:scripts>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
        <script>
            (function() {
                var map = L.map('home-stores-map', {
                    zoomControl: false,
                    scrollWheelZoom: false
                }).setView([-8.9, 13.2], 10);

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
                    <div class="map-store-popup p-1" style="max-width: 250px; font-family: sans-serif; pointer-events: auto;">
                        ${imgHtml}
                        <div class="flex items-center justify-between gap-2 mb-2" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <h4 class="font-bold text-gray-900 m-0 text-sm leading-tight" style="margin: 0; font-size: 13px;">${store.name}</h4>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold ${badgeClass}" style="padding: 2px 6px; border-radius: 9999px; font-size: 10px;">
                                ${store.status_label.label}
                            </span>
                        </div>
                        <p class="text-xs text-gray-500" style="margin: 0 0 4px; font-size: 11px; line-height: 1.3;"><i class="fas fa-map-marker-alt text-gray-400 mr-1"></i> ${store.address}</p>
                        ${store.phone ? `<p class="text-xs text-gray-500" style="margin: 0 0 6px; font-size: 11px;"><i class="fas fa-phone-alt text-gray-400 mr-1"></i> <a href="tel:${store.phone}" style="color: #45B500; text-decoration: none;">${store.phone}</a></p>` : ''}
                        <div class="flex gap-2 mt-3 pt-2 border-t border-gray-100" style="display: flex; gap: 8px; border-top: 1px solid #f3f4f6; padding-top: 8px;">
                            <a href="/lojas/${store.slug}" style="flex: 1; text-align: center; padding: 6px 0; font-size: 10px; font-weight: bold; color: #45B500; border: 1px solid #45B500; border-radius: 8px; text-decoration: none; cursor: pointer;">Detalhes</a>
                            <a href="https://www.google.com/maps/dir/?api=1&destination=${store.lat},${store.lng}" target="_blank" style="flex: 1; text-align: center; padding: 6px 0; font-size: 10px; font-weight: bold; color: white; background: #45B500; border-radius: 8px; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 4px; cursor: pointer;">Como Chegar</a>
                        </div>
                    </div>
                `;
                }

                // Logica do Hero Slider
                const slides = document.querySelectorAll('.slide');
                const dots = document.querySelectorAll('.slider-dot');
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
                            dot.classList.remove('bg-white/30');
                            dot.classList.add('bg-white');
                        } else {
                            dot.classList.remove('bg-white');
                            dot.classList.add('bg-white/30');
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

                // Lendo dados diretamente do banco de dados do Laravel
                var stores = @json($stores);
                var activeMarkers = [];

                stores.forEach(function(s) {
                    if (s.lat && s.lng) {
                        var marker = L.marker([parseFloat(s.lat), parseFloat(s.lng)], {
                                icon: customIcon
                            })
                            .addTo(map)
                            .bindPopup(createPopupHtml(s));
                        activeMarkers.push(marker);
                    }
                });

                // Adjust map view to encompass all markers on load
                if (activeMarkers.length > 0) {
                    var group = new L.featureGroup(activeMarkers);
                    map.fitBounds(group.getBounds().pad(0.15));
                }
            })();
        </script>
    </x-slot>
</x-frontend.layout>
