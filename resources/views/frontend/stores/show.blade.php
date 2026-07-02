<x-frontend.layout>
    <x-slot:meta_title>Fresmart {{ $store->name }} - Nossas Lojas</x-slot>
    <x-slot:meta_description>Visite a Fresmart {{ $store->name }} localizada em {{ $store->address }}. Horário: {{ $store->schedule }}.</x-slot>
    @if($store->image)
        <x-slot:meta_image>{{ str_starts_with($store->image, 'uploads/') ? $store->image : 'storage/' . $store->image }}</x-slot>
    @endif
    <x-frontend.page-header :title="$store->name" :subtitle="$store->city . ($store->bairro ? ' • ' . $store->bairro : '')" image="assets/img/slider1.png" />

    <section class="py-16 w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[1528px] mx-auto min-h-[60vh]">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            
            <!-- Left Column: Details -->
            <div class="space-y-6">
                @if($store->image)
                    <div class="w-full rounded-2xl overflow-hidden shadow-md border border-gray-100">
                        <img src="{{ asset(str_starts_with($store->image, 'uploads/') ? $store->image : 'storage/' . $store->image) }}" alt="{{ $store->name }}" class="w-full h-[280px] object-cover">
                    </div>
                @else
                    <div class="w-full rounded-2xl overflow-hidden shadow-md border border-gray-100">
                        <img src="{{ asset('assets/img/loja.png') }}" alt="{{ $store->name }}" class="w-full h-[280px] object-cover">
                    </div>
                @endif

                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-info-circle text-[#45B500]"></i> Informações da Loja
                    </h2>
                    
                    <div class="space-y-6 text-sm">
                        <!-- Endereço -->
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-green-50 text-[#45B500] flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">Endereço</p>
                                <p class="text-gray-600 mt-1">{{ $store->address }}</p>
                                <p class="text-xs text-gray-400 font-semibold mt-0.5">{{ $store->city }} @if($store->bairro) • {{ $store->bairro }} @endif</p>
                            </div>
                        </div>

                        <!-- Estado Atual -->
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-green-50 text-[#45B500] flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="far fa-clock"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">Horário de Funcionamento</p>
                                <p class="text-gray-600 mt-1">{{ $store->schedule }}</p>
                                <div class="mt-2">
                                    @php
                                        $status = $store->status_label;
                                        $badgeColor = $status['color'] === 'green' ? 'bg-green-50 text-green-700 border-green-100' : ($status['color'] === 'yellow' ? 'bg-yellow-50 text-yellow-700 border-yellow-100' : 'bg-red-50 text-red-700 border-red-100');
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $badgeColor }}">
                                        <span class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $status['color'] === 'green' ? 'bg-green-500' : ($status['color'] === 'yellow' ? 'bg-yellow-500' : 'bg-red-500') }}"></span>
                                        {{ $status['label'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Contactos -->
                        @if($store->phone || $store->email)
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-full bg-green-50 text-[#45B500] flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">Contactos</p>
                                    @if($store->phone)
                                        <p class="text-gray-600 mt-1 flex items-center gap-1.5">
                                            <span>Telefone:</span>
                                            <a href="tel:{{ $store->phone }}" class="text-[#45B500] hover:underline font-semibold">{{ $store->phone }}</a>
                                        </p>
                                    @endif
                                    @if($store->email)
                                        <p class="text-gray-600 mt-1 flex items-center gap-1.5">
                                            <span>E-mail:</span>
                                            <a href="mailto:{{ $store->email }}" class="text-[#45B500] hover:underline font-semibold">{{ $store->email }}</a>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-between gap-4">
                        <a href="{{ route('stores.index') }}" class="text-[#45B500] font-bold hover:underline inline-flex items-center gap-2">
                            &larr; Voltar para todas as lojas
                        </a>
                        
                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $store->lat }},{{ $store->lng }}" target="_blank" class="bg-[#45B500] hover:bg-[#3a9900] text-white font-bold py-2.5 px-5 rounded-xl shadow-sm transition-all duration-300 flex items-center gap-2">
                            <i class="fas fa-directions"></i> Como chegar
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Right Column: Map -->
            <div class="w-full rounded-2xl overflow-hidden shadow-lg border border-gray-100 h-[480px] lg:h-[600px] sticky top-[96px] z-10">
                <div id="store-map" class="w-full h-full"></div>
            </div>
        </div>
    </section>

    <x-slot:scripts>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
        <script>
            (function () {
                var map = L.map('store-map', { zoomControl: true, scrollWheelZoom: false }).setView([{{ $store->lat ?? '-8.9175' }}, {{ $store->lng ?? '13.1866' }}], 15);
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { 
                    maxZoom: 18,
                    attribution: '&copy; OpenStreetMap'
                }).addTo(map);
                
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

                @if($store->lat && $store->lng)
                L.marker([{{ $store->lat }}, {{ $store->lng }}], { icon: customIcon })
                    .addTo(map)
                    .bindPopup('<strong style="font-family: sans-serif;">{{ $store->name }}</strong><br><span style="font-family: sans-serif; font-size:11px; color:#50575e;">{{ $store->address }}</span>')
                    .openPopup();
                @endif
            })();
        </script>
    </x-slot>
</x-frontend.layout>
