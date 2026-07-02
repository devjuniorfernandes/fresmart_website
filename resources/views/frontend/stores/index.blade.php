<x-frontend.layout>
    <x-slot:head_scripts>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
        <style>
            #stores-map {
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

    <!-- Page Header with Integrated Search and Filters -->
    <div class="relative w-full min-h-[340px] bg-gray-900 flex items-center justify-center overflow-hidden py-16">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="{{ $settings->banner_stores_image ? asset($settings->banner_stores_image) : asset('assets/img/slider1.png') }}" alt="{{ $settings->banner_stores_title ?: 'Nossas Lojas' }}"
                class="w-full h-full object-cover object-center opacity-60">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        </div>

        <!-- Header Content -->
        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto w-full mt-10 flex flex-col items-center gap-8">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-white uppercase tracking-wider shadow-sm">
                    {{ $settings->banner_stores_title ?: 'Nossas Lojas' }}
                </h1>
                <p class="mt-2 text-base md:text-lg text-white/95 font-light">
                    {{ $settings->banner_stores_subtitle ?: 'Encontre a Fresmart mais próxima de você' }}
                </p>
            </div>

            <!-- Horizontal Search & Filters Panel -->
            <div
                class="w-full max-w-4xl bg-white/95 backdrop-blur-md p-4 rounded-2xl border border-white/20 shadow-2xl flex flex-col md:flex-row items-center gap-3">
                <!-- Search Input -->
                <div class="relative flex-1 w-full">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" id="search-input" placeholder="Pesquisar loja ou localização..."
                        class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl text-sm focus:border-green-500 focus:ring focus:ring-green-100 focus:outline-none transition-all duration-300 bg-white">
                </div>

                <!-- City Filter -->
                <div class="w-full md:w-56">
                    <select id="city-filter"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:border-green-500 focus:outline-none transition-all bg-white">
                        <option value="">Todas as cidades</option>
                        @foreach ($stores->pluck('city')->unique()->filter()->values() as $city)
                            <option value="{{ $city }}">{{ $city }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Open Now Checkbox -->
                <div
                    class="flex items-center gap-2 select-none px-3 py-2 whitespace-nowrap bg-white border border-gray-200 rounded-xl w-full md:w-auto justify-center">
                    <input type="checkbox" id="open-now-filter"
                        class="rounded text-[#45B500] focus:ring-[#45B500] border-gray-200 w-4 h-4">
                    <label for="open-now-filter" class="text-sm font-bold text-gray-600 cursor-pointer">Apenas
                        abertas</label>
                </div>
            </div>
        </div>
    </div>

    <section class="w-[100%] md:w-[100%] max-w-[1528px] mx-auto">
        <!-- Wrapper container: behaves relative/full-height on desktop, stacks on mobile -->
        <div class="flex flex-col lg:relative lg:w-full lg:h-[700px] overflow-hidden gap-6 lg:gap-0 bg-transparent">

            <!-- Map Backdrop: absolute full-size on desktop, static 450px block on mobile -->
            <div
                class="w-full h-[450px] lg:absolute lg:inset-0 lg:w-full lg:h-full z-0 order-2 lg:order-1 rounded-3xl lg:rounded-none overflow-hidden shadow-md lg:shadow-none border border-gray-100 lg:border-none">
                <div id="stores-map"></div>
            </div>

            <!-- Floating Sidebar: absolute left overlay on desktop, normal column on mobile -->
            <div
                class="w-full lg:absolute lg:left-6 lg:top-6 lg:bottom-6 lg:z-10 lg:max-w-[420px] flex flex-col gap-4 pointer-events-none order-1 lg:order-2 px-1 lg:px-0 h-[500px] lg:h-auto">

                <!-- Stores Counter & Location Alert (pointer-events-auto) -->
                <div
                    class="flex items-center justify-between px-4 py-2.5 rounded-xl bg-white/95 backdrop-blur-sm border border-gray-100 shadow-md pointer-events-auto">
                    <span id="store-count" class="text-xs font-bold text-gray-700">
                        {{ count($stores) }} lojas encontradas
                    </span>
                    <span id="location-status" class="text-[10px] text-green-600 font-bold hidden items-center gap-1">
                        <i class="fas fa-location-arrow"></i> Proximidade ativada
                    </span>
                </div>

                <!-- Scrollable List Container (pointer-events-auto) -->
                <div id="store-list-container"
                    class="flex-1 overflow-y-auto space-y-4 pr-1 custom-scrollbar pointer-events-auto">
                    @forelse($stores as $store)
                        <div id="store-card-{{ $store->id }}" data-id="{{ $store->id }}"
                            onclick="selectStore({{ $store->id }}, true)"
                            class="store-card bg-white/95 backdrop-blur-sm p-4 rounded-2xl border border-gray-100 shadow-md hover:shadow-lg hover:border-green-300 transition-all duration-300 cursor-pointer flex flex-col gap-3 relative group">

                            <!-- Card Body: Split with Image & Info -->
                            <div class="flex gap-4">
                                <!-- Store Cover Image -->
                                <div
                                    class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl overflow-hidden flex-shrink-0 border border-gray-100 relative bg-gray-50">
                                    @if ($store->image)
                                        <img src="{{ asset(str_starts_with($store->image, 'uploads/') ? $store->image : 'storage/' . $store->image) }}" alt="{{ $store->name }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <img src="{{ asset('assets/img/loja.png') }}" alt="{{ $store->name }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @endif
                                </div>

                                <!-- Store Content -->
                                <div class="flex-1 min-w-0 flex flex-col justify-between">
                                    <div class="flex items-start justify-between gap-2">
                                        <div class="min-w-0">
                                            <h3
                                                class="font-bold text-gray-900 text-xs sm:text-sm leading-tight group-hover:text-[#45B500] transition-colors truncate">
                                                {{ $store->name }}</h3>
                                            <p class="text-[10px] text-gray-400 font-semibold mt-0.5 truncate">
                                                {{ $store->city }} @if ($store->bairro)
                                                    • {{ $store->bairro }}
                                                @endif
                                            </p>
                                        </div>

                                        <!-- Dynamic Status Badge -->
                                        @php
                                            $status = $store->status_label;
                                            $badgeClass =
                                                $status['color'] === 'green'
                                                    ? 'bg-green-50 text-green-700 border-green-100'
                                                    : ($status['color'] === 'yellow'
                                                        ? 'bg-yellow-50 text-yellow-700 border-yellow-100'
                                                        : 'bg-red-50 text-red-700 border-red-100');
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-bold border {{ $badgeClass }} whitespace-nowrap">
                                            <span
                                                class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $status['color'] === 'green' ? 'bg-green-500' : ($status['color'] === 'yellow' ? 'bg-yellow-500' : 'bg-red-500') }}"></span>
                                            {{ $status['label'] }}
                                        </span>
                                    </div>

                                    <!-- Details lines -->
                                    <div class="space-y-1.5 text-[10px] text-gray-500 mt-2">
                                        <div class="flex items-start gap-1.5">
                                            <i
                                                class="fas fa-map-marker-alt text-gray-400 mt-0.5 w-3.5 text-center flex-shrink-0"></i>
                                            <span class="leading-tight truncate-2-lines">{{ $store->address }}</span>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <i class="far fa-clock text-gray-400 w-3.5 text-center flex-shrink-0"></i>
                                            <span class="truncate">{{ $store->schedule }}</span>
                                        </div>
                                        @if ($store->phone)
                                            <div class="flex items-center gap-1.5">
                                                <i
                                                    class="fas fa-phone-alt text-gray-400 w-3.5 text-center flex-shrink-0"></i>
                                                <a href="tel:{{ $store->phone }}"
                                                    class="hover:text-[#45B500] transition-colors truncate"
                                                    onclick="event.stopPropagation();">{{ $store->phone }}</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Card Footer: Distance and Action Buttons -->
                            <div class="flex items-center justify-between gap-3 pt-2.5 border-t border-gray-100">
                                <!-- Distance Badge (populated by JS) -->
                                <span id="distance-badge-{{ $store->id }}"
                                    class="hidden text-[9px] bg-green-50 text-green-700 border border-green-100 px-2.5 py-0.5 rounded-full font-bold">
                                    -- km
                                </span>

                                <div class="flex gap-1.5 flex-1 justify-end">
                                    <a href="{{ route('stores.show', $store) }}"
                                        class="text-center py-1.5 px-3 text-[10px] font-bold text-[#45B500] border border-[#45B500] rounded-xl hover:bg-[#45B500] hover:text-white transition-all duration-300"
                                        onclick="event.stopPropagation();">
                                        Ver detalhes
                                    </a>
                                    <a href="https://www.google.com/maps/dir/?api=1&destination={{ $store->lat }},{{ $store->lng }}"
                                        target="_blank"
                                        class="text-center py-1.5 px-3 text-[10px] font-bold text-white bg-[#45B500] rounded-xl hover:bg-[#3a9900] transition-all duration-300 flex items-center gap-1"
                                        onclick="event.stopPropagation();">
                                        <i class="fas fa-directions"></i> Como chegar
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 bg-white border border-gray-100 rounded-2xl shadow-sm">
                            <i class="fas fa-store-slash text-4xl text-gray-300 mb-3 block"></i>
                            <p class="text-gray-500 font-medium">Nenhuma loja cadastrada.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <x-slot:scripts>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
        <script>
            var map;
            var mapMarkers = {};
            var storesData = @json($stores);
            var activeCardId = null;

            document.addEventListener('DOMContentLoaded', function() {
                // Initialize map centered generally on Luanda initially, but fits bounds later
                map = L.map('stores-map', {
                    zoomControl: false,
                    scrollWheelZoom: false
                }).setView([-8.9, 13.2], 10);

                // Add zoom control in top-right
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

                // Create and add markers to map
                storesData.forEach(function(store) {
                    if (store.lat && store.lng) {
                        var marker = L.marker([parseFloat(store.lat), parseFloat(store.lng)], {
                                icon: customIcon
                            })
                            .addTo(map)
                            .bindPopup(createPopupHtml(store));

                        mapMarkers[store.id] = marker;

                        // Click marker sync event
                        marker.on('click', function() {
                            selectStore(store.id, false);
                            scrollToCard(store.id);
                        });
                    }
                });

                // Fit map bounds to show all markers initially
                fitMapBounds();

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
                            <a href="https://www.google.com/maps/dir/?api=1&destination=${store.lat},${store.lng}" target="_blank" style="flex: 1; text-align: center; padding: 6px 0; font-size: 10px; font-weight: bold; color: white; bg-color: #45B500; background: #45B500; border-radius: 8px; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 4px; cursor: pointer;">Como Chegar</a>
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
                    // Scroll container to show card
                    var topPos = card.offsetTop - listContainer.offsetTop;
                    listContainer.scrollTo({
                        top: topPos - 12,
                        behavior: 'smooth'
                    });
                }
            }

            // Check if store matches all active filters
            function isStoreMatch(store, query, selectedCity, openOnly) {
                // 1. Text Search Filter
                if (query) {
                    var nameMatch = store.name.toLowerCase().includes(query);
                    var cityMatch = store.city.toLowerCase().includes(query);
                    var bairroMatch = (store.bairro || '').toLowerCase().includes(query);
                    var addressMatch = store.address.toLowerCase().includes(query);
                    if (!nameMatch && !cityMatch && !bairroMatch && !addressMatch) {
                        return false;
                    }
                }

                // 2. City Filter
                if (selectedCity && store.city !== selectedCity) {
                    return false;
                }

                // 3. Open Now Filter
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

                // Update counter text
                document.getElementById('store-count').innerText = `${visibleCount} lojas encontradas`;

                // Recenter map bounds to remaining visible markers
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

                        // Calculate distance to each store
                        storesData.forEach(function(store) {
                            if (store.lat && store.lng) {
                                var dist = calculateHaversine(userLat, userLng, parseFloat(store.lat),
                                    parseFloat(store.lng));
                                store.distance = dist;

                                // Update distance element
                                var distBadge = document.getElementById(`distance-badge-${store.id}`);
                                if (distBadge) {
                                    distBadge.innerText = `${dist.toFixed(1)} km`;
                                    distBadge.classList.remove('hidden');
                                }
                            }
                        });

                        // Show location info alert
                        document.getElementById('location-status').classList.remove('hidden');
                        document.getElementById('location-status').classList.add('flex');

                        // Sort the cards DOM by distance
                        sortCardsByDistance();

                    }, function(err) {
                        console.warn("Geolocation permission denied or error: ", err.message);
                    });
                }
            }

            // Compute distance using Haversine
            function calculateHaversine(lat1, lon1, lat2, lon2) {
                var R = 6371; // Earth radius in km
                var dLat = (lat2 - lat1) * Math.PI / 180;
                var dLon = (lon2 - lon1) * Math.PI / 180;
                var a =
                    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                    Math.sin(dLon / 2) * Math.sin(dLon / 2);
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                return R * c;
            }

            // Sort store cards inside list container
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

                // Clear and re-append sorted elements
                cards.forEach(function(card) {
                    listContainer.appendChild(card);
                });
            }
        </script>
    </x-slot>
</x-frontend.layout>
