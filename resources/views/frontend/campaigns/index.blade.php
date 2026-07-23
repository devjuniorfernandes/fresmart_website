<x-frontend.layout>
    <x-frontend.page-header 
        title="{{ $settings->banner_campaigns_title ?: 'Promoções & Campanhas' }}" 
        subtitle="{{ $settings->banner_campaigns_subtitle ?: 'Os melhores preços e folhetos para si' }}"
        image="{{ $settings->banner_campaigns_image ? asset($settings->banner_campaigns_image) : asset('assets/img/Ofertas Imperdíveis.jpg') }}" />

    <div class="py-16 md:py-24 bg-gray-50/50 w-full min-h-[60vh] space-y-20">
        
        <!-- SECTION 1: INTERACTIVE LEAFLETS -->
        <section class="w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[1528px] mx-auto">
            <div class="border-b border-gray-100 pb-4 mb-10 flex flex-col sm:flex-row justify-between sm:items-end gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 uppercase tracking-tight">Folhetos Promocionais</h2>
                    <p class="text-sm text-gray-500 mt-1">Folheie os nossos catálogos atuais e planeie as suas compras com antecedência.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($leaflets as $leaflet)
                    @php
                        $pagesArray = is_array($leaflet->images) ? $leaflet->images : (json_decode($leaflet->images, true) ?: []);
                        $coverImage = count($pagesArray) > 0 ? $pagesArray[0] : 'assets/img/slider1.png';
                    @endphp
                    <div class="bg-white border border-gray-100 rounded-3xl shadow-sm hover:shadow-md overflow-hidden transition-all duration-300 flex flex-col justify-between group">
                        <div class="relative overflow-hidden aspect-[3/4] bg-gray-50 border-b border-gray-50">
                            <img src="{{ asset($coverImage) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $leaflet->title }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-6">
                                <button onclick="openLeafletModal('{{ $leaflet->title }}', {{ json_encode(array_map(fn($p) => asset($p), $pagesArray)) }}, '{{ $leaflet->pdf_path ? asset($leaflet->pdf_path) : '' }}')"
                                    class="bg-[#45B500] hover:bg-[#3a9900] text-white font-bold text-xs uppercase px-6 py-2.5 rounded-xl shadow transition-all cursor-pointer">
                                    Folhear Catálogo
                                </button>
                            </div>
                        </div>
                        <div class="p-6 space-y-4">
                            <div>
                                <h3 class="font-extrabold text-gray-900 text-sm leading-snug line-clamp-2">{{ $leaflet->title }}</h3>
                                <p class="text-[11px] font-bold text-[#45B500] uppercase tracking-wider mt-1.5 flex items-center gap-1.5">
                                    <i class="far fa-calendar-alt"></i> 
                                    Válido: {{ \Carbon\Carbon::parse($leaflet->start_date)->format('d/m') }} a {{ \Carbon\Carbon::parse($leaflet->end_date)->format('d/m/Y') }}
                                </p>
                            </div>
                            <div class="pt-2 flex gap-2">
                                <button onclick="openLeafletModal('{{ $leaflet->title }}', {{ json_encode(array_map(fn($p) => asset($p), $pagesArray)) }}, '{{ $leaflet->pdf_path ? asset($leaflet->pdf_path) : '' }}')"
                                    class="flex-1 text-center py-2 bg-green-50 hover:bg-[#45B500] text-[#45B500] hover:text-white font-bold text-xs rounded-xl transition-all border border-green-100 cursor-pointer">
                                    Folhear
                                </button>
                                @if($leaflet->pdf_path)
                                    <a href="{{ asset($leaflet->pdf_path) }}" download class="px-3 py-2 bg-gray-50 hover:bg-gray-100 text-gray-600 rounded-xl transition-all border border-gray-100 flex items-center justify-center" title="Descarregar PDF">
                                        <i class="fas fa-download text-xs"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-3xl p-12 text-center border border-gray-100 shadow-sm">
                        <i class="far fa-folder-open text-4xl text-gray-300 mb-3 block"></i>
                        <p class="text-gray-500 font-semibold text-sm">De momento, não existem folhetos promocionais ativos. Volte em breve!</p>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- SECTION 2: STANDALONE CAMPAIGNS -->
        <section class="w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[1528px] mx-auto border-t border-gray-100 pt-20">
            <div class="border-b border-gray-100 pb-4 mb-10">
                <h2 class="text-3xl font-extrabold text-gray-900 uppercase tracking-tight">Campanhas em Destaque</h2>
                <p class="text-sm text-gray-500 mt-1">Conheça as nossas ofertas sazonais e campanhas imperdíveis.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($campaigns as $campaign)
                    <x-frontend.card-campaign :campaign="$campaign" />
                @empty
                    <div class="col-span-full text-center py-20 text-gray-400 text-sm">Nenhuma campanha em destaque disponível.</div>
                @endforelse
            </div>
            
            <div class="mt-12 flex justify-center">
                {{ $campaigns->links() }}
            </div>
        </section>
    </div>

    <!-- FOLHETO INTERACTIVE MODAL OVERLAY -->
    <div id="leaflet-modal" class="fixed inset-0 z-[9999] bg-black/95 flex flex-col justify-between hidden opacity-0 transition-opacity duration-300">
        
        <!-- Modal Top Bar -->
        <div class="flex items-center justify-between px-6 py-4 bg-black/40 border-b border-white/10 text-white z-10">
            <div>
                <h4 id="modal-leaflet-title" class="font-extrabold text-sm sm:text-base leading-snug">Folheto</h4>
                <p id="modal-page-counter" class="text-xs text-gray-400 mt-0.5">Página 1 de 1</p>
            </div>
            <div class="flex items-center gap-4">
                <a id="modal-download-pdf" href="#" download class="hidden text-xs bg-white/10 hover:bg-white/20 text-white font-bold py-2 px-4 rounded-xl transition-all flex items-center gap-2">
                    <i class="fas fa-download"></i> <span class="hidden sm:inline">Descarregar PDF</span>
                </a>
                <button onclick="closeLeafletModal()" class="text-white hover:text-red-400 text-lg transition-colors cursor-pointer p-1">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <!-- Modal Center Slider container -->
        <div class="flex-1 flex items-center justify-between px-4 sm:px-8 relative overflow-hidden">
            <!-- Prev Button -->
            <button onclick="slidePrev()" class="bg-black/50 hover:bg-white text-white hover:text-black border border-white/20 hover:border-transparent w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center text-sm transition-all cursor-pointer z-10">
                <i class="fas fa-chevron-left"></i>
            </button>

            <!-- Slide Main Image Container -->
            <div class="flex-1 flex items-center justify-center max-h-[75vh] mx-4 relative">
                <img id="modal-leaflet-image" src="" class="max-w-full max-h-[75vh] rounded-xl shadow-2xl object-contain transition-all duration-300 scale-95" alt="Página do Folheto">
            </div>

            <!-- Next Button -->
            <button onclick="slideNext()" class="bg-black/50 hover:bg-white text-white hover:text-black border border-white/20 hover:border-transparent w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center text-sm transition-all cursor-pointer z-10">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <!-- Modal Bottom Navigation (Keyboard tips or indicators) -->
        <div class="bg-black/40 border-t border-white/10 py-4 px-6 text-center text-[10px] text-gray-500 flex justify-between items-center z-10">
            <span class="hidden sm:inline">Use as setas ← → do seu teclado para folhear</span>
            <div class="flex justify-center flex-1 space-x-1.5" id="dots-container"></div>
            <span class="text-[10px] text-gray-400">Fresmart</span>
        </div>
    </div>

    <!-- Leaflet Modal Logic Script -->
    <x-slot:scripts>
        <script>
            var currentPages = [];
            var currentPageIndex = 0;

            function openLeafletModal(title, pages, pdfPath) {
                currentPages = pages;
                currentPageIndex = 0;

                document.getElementById('modal-leaflet-title').innerText = title;
                
                // Show PDF download button if path exists
                var downloadBtn = document.getElementById('modal-download-pdf');
                if (pdfPath) {
                    downloadBtn.href = pdfPath;
                    downloadBtn.classList.remove('hidden');
                } else {
                    downloadBtn.classList.add('hidden');
                }

                // Show modal overlay
                var modal = document.getElementById('leaflet-modal');
                modal.classList.remove('hidden');
                setTimeout(function() {
                    modal.classList.remove('opacity-0');
                }, 50);

                updateSlideContent();
                
                // Add Keyboard event listener
                document.addEventListener('keydown', handleKeyboardNav);
            }

            function closeLeafletModal() {
                var modal = document.getElementById('leaflet-modal');
                modal.classList.add('opacity-0');
                setTimeout(function() {
                    modal.classList.add('hidden');
                }, 300);

                // Remove Keyboard event listener
                document.removeEventListener('keydown', handleKeyboardNav);
            }

            function updateSlideContent() {
                var imageEl = document.getElementById('modal-leaflet-image');
                
                // Smooth scale down effect
                imageEl.classList.remove('scale-100');
                imageEl.classList.add('scale-95');

                setTimeout(function() {
                    imageEl.src = currentPages[currentPageIndex];
                    
                    // Smooth scale back up
                    setTimeout(function() {
                        imageEl.classList.remove('scale-95');
                        imageEl.classList.add('scale-100');
                    }, 50);
                }, 150);

                // Update counter
                document.getElementById('modal-page-counter').innerText = 'Página ' + (currentPageIndex + 1) + ' de ' + currentPages.length;

                // Render Dots
                renderDots();
            }

            function slidePrev() {
                if (currentPages.length <= 1) return;
                currentPageIndex = (currentPageIndex - 1 + currentPages.length) % currentPages.length;
                updateSlideContent();
            }

            function slideNext() {
                if (currentPages.length <= 1) return;
                currentPageIndex = (currentPageIndex + 1) % currentPages.length;
                updateSlideContent();
            }

            function renderDots() {
                var container = document.getElementById('dots-container');
                container.innerHTML = '';
                
                // limit dots if too many pages
                var limit = 15;
                if (currentPages.length <= limit) {
                    currentPages.forEach(function(_, idx) {
                        var dot = document.createElement('button');
                        dot.className = 'w-1.5 h-1.5 rounded-full transition-all duration-300 ' + 
                                        (idx === currentPageIndex ? 'bg-[#45B500] w-3' : 'bg-white/20 hover:bg-white/40');
                        dot.onclick = function() {
                            currentPageIndex = idx;
                            updateSlideContent();
                        };
                        container.appendChild(dot);
                    });
                }
            }

            function handleKeyboardNav(event) {
                if (event.key === 'ArrowLeft') {
                    slidePrev();
                } else if (event.key === 'ArrowRight') {
                    slideNext();
                } else if (event.key === 'Escape') {
                    closeLeafletModal();
                }
            }
        </script>
    </x-slot:scripts>
</x-frontend.layout>
