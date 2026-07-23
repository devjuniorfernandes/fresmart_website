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

    <!-- Hero Slider Section - DESKTOP (Dinâmico) -->
    <header id="hero-slider-desktop"
        class="hidden sm:relative sm:h-[350px] md:h-[400px] text-white sm:flex items-center overflow-hidden w-full bg-gray-900 shadow-inner">

        @forelse($slides as $index => $slide)
            <div
                class="desktop-slide slide absolute inset-0 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }} transition-opacity duration-1000 z-10">
                <div class="absolute inset-0 z-0">
                    <img src="{{ asset(str_starts_with($slide->image, 'uploads/') ? $slide->image : 'storage/' . $slide->image) }}"
                        alt="{{ $slide->title ?? 'Banner' }}" class="w-full h-full object-cover object-center">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/30 to-transparent"></div>
                </div>
                <div class="hero-content h-full w-full flex flex-col justify-center relative z-10">
                    <div class="max-w-[1528px] mx-auto px-6 lg:px-10 w-full">
                        <div class="md:w-1/2 space-y-4">
                            @if (trim($slide->title) || trim($slide->subtitle))
                                <h2 class="text-xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight uppercase drop-shadow-md">
                                    {{ $slide->title }}
                                    @if (trim($slide->subtitle))
                                        <br> <span class="text-[#7dd82a]">{{ $slide->subtitle }}</span>
                                    @endif
                                </h2>
                            @endif
                            <div class="flex flex-wrap gap-3 pt-2">
                                @if ($slide->link)
                                    <a href="{{ $slide->link }}"
                                        class="bg-[#45B500] hover:bg-white hover:text-[#1b5314] text-white transition-all duration-300 font-bold py-2 px-6 rounded-xl text-center shadow-md text-xs sm:text-sm uppercase tracking-wider">
                                        SAIBA MAIS
                                    </a>
                                @endif
                                <a href="#lojas"
                                    class="bg-white/10 hover:bg-[#45B500] hover:text-white text-white border border-white/20 hover:border-transparent transition-all duration-300 font-bold py-2 px-6 rounded-xl text-center shadow-md text-xs sm:text-sm uppercase tracking-wider">
                                    NOSSAS LOJAS
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <!-- Fallback if no campaigns exist -->
            <div class="desktop-slide slide absolute inset-0 opacity-100 transition-opacity duration-1000 z-10">
                <div class="absolute inset-0 z-0">
                    <img src="{{ asset('assets/img/hero.png') }}" alt="FRESMART Banner 1"
                        class="w-full h-full object-cover object-center">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/30 to-transparent"></div>
                </div>
                <div class="hero-content h-full w-full flex flex-col justify-center relative z-10">
                    <div class="max-w-[1528px] mx-auto px-6 lg:px-10 w-full">
                        <div class="md:w-1/2 space-y-4">
                            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight uppercase drop-shadow-md">
                                SERVINDO ANGOLA<br>COM <span class="text-[#7dd82a]">CORAÇÃO</span>
                            </h2>
                            <div class="flex gap-3 pt-2">
                                <a href="#lojas"
                                    class="bg-[#45B500] hover:bg-white hover:text-[#1b5314] text-white transition-all duration-300 font-bold py-2 px-6 rounded-xl text-center shadow-md text-xs sm:text-sm uppercase tracking-wider">
                                    NOSSAS LOJAS
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse

        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex space-x-2 z-30">
            @foreach ($slides as $index => $slide)
                <button
                    class="desktop-slider-dot w-2.5 h-2.5 rounded-full {{ $index === 0 ? 'bg-white' : 'bg-white/30' }} transition-all duration-300"
                    data-index="{{ $index }}"></button>
            @endforeach
        </div>
    </header>

    <!-- Hero Slider Section - MOBILE CARD CAROUSEL (Dinâmico) -->
    <section id="hero-slider-mobile" class="block sm:hidden bg-white py-6 w-full overflow-hidden relative border-b border-gray-100">
        <div class="w-full overflow-hidden">
            <!-- Slider Track -->
            <div id="mobile-slider-track" class="flex transition-transform duration-500 ease-out" style="transform: translateX(6.5vw); width: max-content;">
                @forelse($slides as $index => $slide)
                    <div class="w-[82vw] mx-[2.5vw] flex-shrink-0 relative overflow-hidden rounded-3xl aspect-[16/10] bg-gray-900 shadow-md">
                        <img src="{{ asset(str_starts_with($slide->image, 'uploads/') ? $slide->image : 'storage/' . $slide->image) }}"
                            alt="{{ $slide->title ?? 'Banner' }}" class="w-full h-full object-cover">
                        <!-- Dark Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/35 to-transparent"></div>
                        <!-- Content -->
                        <div class="absolute inset-0 p-6 flex flex-col justify-end text-white space-y-2">
                            @if (trim($slide->title) || trim($slide->subtitle))
                                <h3 class="text-sm font-extrabold tracking-tight uppercase leading-tight line-clamp-2">
                                    {{ $slide->title }}
                                    @if (trim($slide->subtitle))
                                        <span class="text-[#7dd82a] block text-[11px] mt-0.5 font-bold">{{ $slide->subtitle }}</span>
                                    @endif
                                </h3>
                            @endif
                            <div class="flex gap-2 pt-1">
                                @if ($slide->link)
                                    <a href="{{ $slide->link }}"
                                        class="bg-[#45B500] text-white font-bold py-1.5 px-4 rounded-lg text-center text-[10px] uppercase tracking-wider">
                                        SAIBA MAIS
                                    </a>
                                @endif
                                <a href="#lojas"
                                    class="bg-white/20 text-white font-bold py-1.5 px-4 rounded-lg text-center text-[10px] uppercase tracking-wider">
                                    LOJAS
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Fallback -->
                    <div class="w-[82vw] mx-[2.5vw] flex-shrink-0 relative overflow-hidden rounded-3xl aspect-[16/10] bg-gray-900 shadow-md">
                        <img src="{{ asset('assets/img/hero.png') }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/35 to-transparent"></div>
                        <div class="absolute inset-0 p-6 flex flex-col justify-end text-white space-y-2">
                            <h3 class="text-sm font-extrabold tracking-tight uppercase leading-tight">
                                SERVINDO ANGOLA<br><span class="text-[#7dd82a]">COM CORAÇÃO</span>
                            </h3>
                            <div class="flex gap-2">
                                <a href="#lojas" class="bg-[#45B500] text-white font-bold py-1.5 px-4 rounded-lg text-center text-[10px] uppercase tracking-wider">LOJAS</a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Mobile Dots Navigation -->
        <div class="flex justify-center space-x-1.5 mt-4" id="mobile-dots-container">
            @foreach ($slides as $index => $slide)
                <button
                    class="mobile-slider-dot w-2 h-2 rounded-full {{ $index === 0 ? 'bg-[#45B500] w-4' : 'bg-gray-300' }} transition-all duration-300"
                    data-index="{{ $index }}"></button>
            @endforeach
        </div>
    </section>

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
    <section id="receitas" class="py-24 bg-white w-full border-t border-b border-gray-50">
        <div class="w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[1528px] mx-auto">
            <h2 id="receitas" class="text-3xl font-bold text-gray-900 uppercase tracking-tight mb-12 animate-on-scroll">Receitas</h2>

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
                <a href="{{ route('recipes.index') }}" class="text-sm font-bold text-[#45B500] hover:underline uppercase tracking-wider">Ver todas as receitas &rarr;</a>
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

    <!-- Encontre nas Lojas (Mapa Dinâmico Completo) -->
    <section id="lojas" class="py-24 bg-white w-full border-t border-gray-50">
        <div class="w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[1528px] mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                
                <!-- Left Column (50%): Title & Text -->
                <div class="space-y-6">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gray-900 uppercase tracking-tight leading-tight">
                        Nossas Lojas
                    </h2>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                        Encontre a loja Fresmart mais próxima de si, consulte os horários, contactos e serviços disponíveis.
                    </p>
                    <p class="text-gray-500 text-xs md:text-sm leading-relaxed">
                        Visite-nos numa das nossas localizações espalhadas por Angola. Clique nos marcadores no mapa para saber o endereço, horários, telefone e serviços associados a cada loja (como Talho, Padaria e Café).
                    </p>
                    <div class="pt-4">
                        <a href="{{ route('stores.index') }}" class="inline-block bg-[#45B500] hover:bg-[#3a9900] text-white font-bold py-3 px-8 rounded-2xl transition-all duration-300 shadow-md text-xs sm:text-sm uppercase tracking-wider">
                            Ver todas as lojas
                        </a>
                    </div>
                </div>

                <!-- Right Column (50%): The Map -->
                <div class="w-full h-[380px] sm:h-[450px] md:h-[500px] rounded-[32px] overflow-hidden shadow-lg border border-gray-100 z-10 relative">
                    <div id="home-stores-map" class="w-full h-full"></div>
                </div>

            </div>
        </div>
    </section>

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
                            dot.classList.remove('bg-gray-300');
                            dot.classList.add('bg-[#45B500]', 'w-4');
                        } else {
                            dot.classList.remove('bg-[#45B500]', 'w-4');
                            dot.classList.add('bg-gray-300');
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
                    }, { passive: true });

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
                    }, { passive: true });
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

                // Start map centered on Luanda with zoom level 12 by default instead of fitting all bounds
                // fitMapBounds();

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
                    imgHtml = `<img src="${window.location.origin}/${imgPath}" class="w-full h-24 object-cover rounded-lg mb-2 border border-gray-100">`;
                } else {
                    imgHtml = `<img src="${window.location.origin}/assets/img/loja.png" class="w-full h-24 object-cover rounded-lg mb-2 border border-gray-100">`;
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
                    card.classList.remove('border-[#45B500]', 'bg-green-50/20', 'shadow-md', 'ring-2', 'ring-[#45B500]/10');
                    card.classList.add('border-gray-100', 'shadow-sm');
                });

                // Add active classes to selected card
                var selectedCard = document.getElementById(`store-card-${storeId}`);
                if (selectedCard) {
                    selectedCard.classList.remove('border-gray-100', 'shadow-sm');
                    selectedCard.classList.add('border-[#45B500]', 'bg-green-50/20', 'shadow-md', 'ring-2', 'ring-[#45B500]/10');
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
                    var nameMatch = store.name.toLowerCase().includes(query);
                    var cityMatch = store.city.toLowerCase().includes(query);
                    var bairroMatch = (store.bairro || '').toLowerCase().includes(query);
                    var addressMatch = store.address.toLowerCase().includes(query);
                    if (!nameMatch && !cityMatch && !bairroMatch && !addressMatch) {
                        return false;
                    }
                }
                if (selectedCity && store.city !== selectedCity) {
                    return false;
                }
                if (openOnly) {
                    var type = store.status_label.type;
                    if (type !== 'open' && type !== 'closing_soon') {
                        return false;
                    }
                }
                return true;
            }

            // Apply active filters to list and map
            function applyFilters() {
                var query = document.getElementById('search-input').value.toLowerCase().trim();
                var selectedCity = document.getElementById('city-filter').value;
                var openOnly = document.getElementById('open-now-filter').checked;

                var visibleCount = 0;
                var activeMarkers = [];

                storesData.forEach(function(store) {
                    var matches = isStoreMatch(store, query, selectedCity, openOnly);
                    var card = document.getElementById(`store-card-${store.id}`);
                    var marker = mapMarkers[store.id];

                    if (matches) {
                        visibleCount++;
                        if (card) card.style.display = 'flex';
                        if (marker) {
                            if (!map.hasLayer(marker)) {
                                marker.addTo(map);
                            }
                            activeMarkers.push(marker);
                        }
                    } else {
                        if (card) card.style.display = 'none';
                        if (marker) {
                            if (map.hasLayer(marker)) {
                                map.removeLayer(marker);
                            }
                        }
                    }
                });

                document.getElementById('store-count').innerText = `${visibleCount} lojas encontradas`;

                if (activeMarkers.length > 0) {
                    var group = new L.featureGroup(activeMarkers);
                    map.fitBounds(group.getBounds().pad(0.15));
                }
            }

            // Adjust map view to encompass all markers
            function fitMapBounds() {
                var markersArray = Object.values(mapMarkers);
                if (markersArray.length > 0) {
                    var group = new L.featureGroup(markersArray);
                    map.fitBounds(group.getBounds().pad(0.15));
                }
            }

            // Geolocation and sorting
            function initGeolocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var userLat = position.coords.latitude;
                        var userLng = position.coords.longitude;

                        storesData.forEach(function(store) {
                            if (store.lat && store.lng) {
                                var dist = calculateHaversine(userLat, userLng, parseFloat(store.lat), parseFloat(store.lng));
                                store.distance = dist;

                                var distBadge = document.getElementById(`distance-badge-${store.id}`);
                                if (distBadge) {
                                    distBadge.innerText = `${dist.toFixed(1)} km`;
                                    distBadge.classList.remove('hidden');
                                }
                            }
                        });

                        document.getElementById('location-status').classList.remove('hidden');
                        document.getElementById('location-status').classList.add('flex');

                        sortCardsByDistance();

                    }, function(err) {
                        console.warn("Geolocation permission denied or error: ", err.message);
                    });
                }
            }

            function calculateHaversine(lat1, lon1, lat2, lon2) {
                var R = 6371; // km
                var dLat = (lat2 - lat1) * Math.PI / 180;
                var dLon = (lon2 - lon1) * Math.PI / 180;
                var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                        Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                        Math.sin(dLon / 2) * Math.sin(dLon / 2);
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                return R * c;
            }

            function sortCardsByDistance() {
                var listContainer = document.getElementById('store-list-container');
                if (!listContainer) return;

                var cards = Array.from(listContainer.querySelectorAll('.store-card'));
                cards.sort(function(a, b) {
                    var idA = parseInt(a.dataset.id);
                    var idB = parseInt(b.dataset.id);

                    var storeA = storesData.find(s => s.id === idA);
                    var storeB = storesData.find(s => s.id === idB);

                    var distA = storeA.distance !== undefined ? storeA.distance : Infinity;
                    var distB = storeB.distance !== undefined ? storeB.distance : Infinity;

                    return distA - distB;
                });

                cards.forEach(function(card) {
                    listContainer.appendChild(card);
                });
            }
        </script>
    </x-slot>
</x-frontend.layout>
