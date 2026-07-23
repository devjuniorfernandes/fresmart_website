<x-frontend.layout>
    <x-frontend.page-header 
        title="Mapa do Site" 
        subtitle="Consulte a estrutura completa do nosso website"
        image="assets/img/slider1.png" />

    <section class="py-16 md:py-24 bg-gray-50/50 w-full min-h-[60vh]">
        <div class="w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[1200px] mx-auto">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                
                <!-- Col 1: Páginas Institucionais -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm space-y-4">
                    <h3 class="font-extrabold text-[#45B500] text-sm uppercase border-b border-gray-50 pb-2 flex items-center gap-2">
                        <i class="fas fa-link"></i> Páginas Principais
                    </h3>
                    <ul class="space-y-2 text-xs font-bold text-gray-700">
                        <li><a href="{{ route('home') }}" class="hover:text-[#45B500] transition-colors">Início</a></li>
                        <li><a href="{{ route('about.index') }}" class="hover:text-[#45B500] transition-colors">Sobre Nós (Quem Somos)</a></li>
                        <li><a href="{{ route('recipes.index') }}" class="hover:text-[#45B500] transition-colors">Receitas</a></li>
                        <li><a href="{{ route('stores.index') }}" class="hover:text-[#45B500] transition-colors">Lojas</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-[#45B500] transition-colors">Serviços</a></li>
                        <li><a href="{{ route('campaigns.index') }}" class="hover:text-[#45B500] transition-colors">Promoções & Campanhas</a></li>
                        <li><a href="{{ route('posts.index') }}" class="hover:text-[#45B500] transition-colors">Notícias & Eventos</a></li>
                        <li><a href="{{ route('contacts.index') }}" class="hover:text-[#45B500] transition-colors">Contactos</a></li>
                    </ul>
                </div>

                <!-- Col 2: Nossas Lojas -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm space-y-4">
                    <h3 class="font-extrabold text-[#45B500] text-sm uppercase border-b border-gray-50 pb-2 flex items-center gap-2">
                        <i class="fas fa-store"></i> Nossas Lojas
                    </h3>
                    <ul class="space-y-2 text-xs text-gray-600">
                        @forelse($stores as $store)
                            <li><a href="{{ route('stores.show', $store->slug) }}" class="hover:text-[#45B500] transition-colors font-semibold">{{ $store->name }}</a></li>
                        @empty
                            <li class="text-gray-400 italic">Sem lojas disponíveis</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Col 3: Nossos Serviços -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm space-y-4">
                    <h3 class="font-extrabold text-[#45B500] text-sm uppercase border-b border-gray-50 pb-2 flex items-center gap-2">
                        <i class="fas fa-concierge-bell"></i> Nossos Serviços
                    </h3>
                    <ul class="space-y-2 text-xs text-gray-600">
                        @forelse($services as $service)
                            <li><a href="{{ route('services.show', $service->slug) }}" class="hover:text-[#45B500] transition-colors font-semibold">{{ $service->name }}</a></li>
                        @empty
                            <li class="text-gray-400 italic">Sem serviços disponíveis</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Col 4: Receitas -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm space-y-4">
                    <h3 class="font-extrabold text-[#45B500] text-sm uppercase border-b border-gray-50 pb-2 flex items-center gap-2">
                        <i class="fas fa-utensils"></i> Receitas & Ideias
                    </h3>
                    <ul class="space-y-2 text-xs text-gray-600">
                        @forelse($recipes as $recipe)
                            <li><a href="{{ route('recipes.show', $recipe->slug) }}" class="hover:text-[#45B500] transition-colors font-semibold">{{ $recipe->title }}</a></li>
                        @empty
                            <li class="text-gray-400 italic">Sem receitas disponíveis</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Col 5: Notícias -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm space-y-4">
                    <h3 class="font-extrabold text-[#45B500] text-sm uppercase border-b border-gray-50 pb-2 flex items-center gap-2">
                        <i class="far fa-newspaper"></i> Notícias & Novidades
                    </h3>
                    <ul class="space-y-2 text-xs text-gray-600">
                        @forelse($posts as $post)
                            <li><a href="{{ route('posts.show', $post->slug) }}" class="hover:text-[#45B500] transition-colors font-semibold">{{ $post->title }}</a></li>
                        @empty
                            <li class="text-gray-400 italic">Sem artigos disponíveis</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Col 6: Campanhas -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm space-y-4">
                    <h3 class="font-extrabold text-[#45B500] text-sm uppercase border-b border-gray-50 pb-2 flex items-center gap-2">
                        <i class="fas fa-tags"></i> Campanhas Promocionais
                    </h3>
                    <ul class="space-y-2 text-xs text-gray-600">
                        @forelse($campaigns as $campaign)
                            <li><a href="{{ route('campaigns.show', $campaign->slug) }}" class="hover:text-[#45B500] transition-colors font-semibold">{{ $campaign->title }}</a></li>
                        @empty
                            <li class="text-gray-400 italic">Sem campanhas disponíveis</li>
                        @endforelse
                    </ul>
                </div>

            </div>
            
        </div>
    </section>
</x-frontend.layout>
