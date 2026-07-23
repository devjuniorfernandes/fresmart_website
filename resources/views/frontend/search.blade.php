<x-frontend.layout>
    <x-frontend.page-header 
        title="{{ __('Resultados de Pesquisa') }}" 
        subtitle="{{ __('Resultados para') }}: &ldquo;{{ $q }}&rdquo;"
        image="assets/img/hero.png" />

    <section class="py-16 w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[1528px] mx-auto min-h-[60vh]">
        @if($recipes->isEmpty() && $products->isEmpty() && $stores->isEmpty() && $posts->isEmpty())
            <div class="text-center py-20 bg-white rounded-3xl border border-gray-100 shadow-sm">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-400">
                    <i class="fas fa-search-minus text-4xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ __('Não foram encontrados resultados para') }} &ldquo;{{ $q }}&rdquo;</h3>
                <p class="text-gray-500 max-w-md mx-auto">Tente utilizar palavras-chave diferentes ou verifique se escreveu corretamente.</p>
                <a href="{{ route('home') }}" class="mt-6 inline-block bg-[#45B500] hover:bg-[#3b9b18] text-white font-bold px-8 py-3 rounded-xl transition-all duration-300 shadow-sm">
                    {{ __('INÍCIO') }}
                </a>
            </div>
        @else
            <div class="space-y-12">
                <!-- 1. SECÇÃO PRODUTOS -->
                @if($products->isNotEmpty())
                    <div class="space-y-6">
                        <h2 class="text-2xl font-bold text-gray-900 border-b border-gray-200 pb-3 flex items-center gap-3">
                            <i class="fas fa-shopping-basket text-[#45B500]"></i> {{ __('PRODUTOS') }}
                            <span class="text-xs bg-green-50 text-[#45B500] px-2.5 py-1 rounded-full font-bold">{{ $products->count() }}</span>
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($products as $prod)
                                <a href="{{ route('products.show', $prod) }}" class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 group flex flex-col justify-between">
                                    <div>
                                        <h3 class="font-bold text-gray-900 text-lg group-hover:text-[#45B500] transition-colors mb-2">{{ $prod->name }}</h3>
                                        <p class="text-gray-500 text-sm line-clamp-3 leading-relaxed mb-4">{{ $prod->description }}</p>
                                    </div>
                                    <span class="text-xs font-bold text-[#45B500] group-hover:underline flex items-center gap-1.5 mt-auto">
                                        {{ __('Detalhes') }} &rarr;
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- 2. SECÇÃO RECEITAS -->
                @if($recipes->isNotEmpty())
                    <div class="space-y-6">
                        <h2 class="text-2xl font-bold text-gray-900 border-b border-gray-200 pb-3 flex items-center gap-3">
                            <i class="fas fa-utensils text-[#45B500]"></i> {{ __('Receitas') }}
                            <span class="text-xs bg-green-50 text-[#45B500] px-2.5 py-1 rounded-full font-bold">{{ $recipes->count() }}</span>
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($recipes as $recipe)
                                <x-frontend.card-recipe :recipe="$recipe" />
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- 3. SECÇÃO LOJAS -->
                @if($stores->isNotEmpty())
                    <div class="space-y-6">
                        <h2 class="text-2xl font-bold text-gray-900 border-b border-gray-200 pb-3 flex items-center gap-3">
                            <i class="fas fa-map-marker-alt text-[#45B500]"></i> {{ __('LOJAS') }}
                            <span class="text-xs bg-green-50 text-[#45B500] px-2.5 py-1 rounded-full font-bold">{{ $stores->count() }}</span>
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                            @foreach($stores as $store)
                                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between gap-4">
                                    <div class="space-y-2">
                                        <div class="flex items-center justify-between gap-2">
                                            <h3 class="font-bold text-gray-900 text-lg">{{ $store->name }}</h3>
                                            @php
                                                $status = $store->status_label;
                                                $badgeColor = $status['color'] === 'green' ? 'bg-green-50 text-green-700 border-green-100' : ($status['color'] === 'yellow' ? 'bg-yellow-50 text-yellow-700 border-yellow-100' : 'bg-red-50 text-red-700 border-red-100');
                                            @endphp
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $badgeColor }}">
                                                {{ $status['label'] }}
                                            </span>
                                        </div>
                                        <p class="text-gray-500 text-sm flex items-start gap-1.5">
                                            <i class="fas fa-map-marker-alt text-[#45B500] mt-0.5 w-4 text-center"></i>
                                            <span>{{ $store->address }}</span>
                                        </p>
                                        @if($store->phone)
                                            <p class="text-gray-500 text-sm flex items-center gap-1.5">
                                                <i class="fas fa-phone-alt text-[#45B500] w-4 text-center"></i>
                                                <a href="tel:{{ $store->phone }}" class="hover:underline">{{ $store->phone }}</a>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="flex gap-3 mt-2 border-t border-gray-100 pt-4">
                                        <a href="{{ route('stores.show', $store) }}" class="flex-1 text-center py-2 text-xs font-bold text-[#45B500] border border-[#45B500] hover:bg-green-50 rounded-xl transition-all">
                                            {{ __('Detalhes') }}
                                        </a>
                                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $store->lat }},{{ $store->lng }}" target="_blank" class="flex-1 text-center py-2 text-xs font-bold text-white bg-[#45B500] hover:bg-[#3b9b18] rounded-xl transition-all">
                                            {{ __('Como Chegar') }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- 4. SECÇÃO NOTÍCIAS (BLOG) -->
                @if($posts->isNotEmpty())
                    <div class="space-y-6">
                        <h2 class="text-2xl font-bold text-gray-900 border-b border-gray-200 pb-3 flex items-center gap-3">
                            <i class="fas fa-newspaper text-[#45B500]"></i> {{ __('Notícias e Eventos') }}
                            <span class="text-xs bg-green-50 text-[#45B500] px-2.5 py-1 rounded-full font-bold">{{ $posts->count() }}</span>
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                            @foreach($posts as $post)
                                <a href="{{ route('posts.show', $post) }}" class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col group h-full">
                                    <div class="h-48 w-full overflow-hidden relative bg-gray-50 border-b border-gray-100">
                                        @if($post->image)
                                            <img src="{{ asset(str_starts_with($post->image, 'uploads/') ? $post->image : 'storage/' . $post->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $post->title }}">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[#45B500] text-3xl">
                                                <i class="fas fa-newspaper"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="p-6 flex flex-col flex-grow">
                                        <h3 class="font-bold text-gray-900 text-lg group-hover:text-[#45B500] transition-colors leading-snug line-clamp-2">{{ $post->title }}</h3>
                                        <p class="text-gray-500 text-sm mt-3 mb-4 line-clamp-3 leading-relaxed flex-grow">{{ $post->excerpt ?: Str::limit(strip_tags($post->content), 120) }}</p>
                                        <span class="text-xs font-bold text-[#45B500] flex items-center gap-1 mt-auto">
                                            Ler notícia &rarr;
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </section>
</x-frontend.layout>
