<x-frontend.layout>
    <x-slot:meta_title>{{ $post->title }} - Notícias Fresmart</x-slot>
    <x-slot:meta_description>{{ Str::limit(strip_tags($post->content), 150) }}</x-slot>
    @if ($post->image)
        <x-slot:meta_image>{{ str_starts_with($post->image, 'uploads/') ? $post->image : 'storage/' . $post->image }}</x-slot>
    @endif

    <div class="bg-white border-b border-gray-100 py-6">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
            <x-frontend.breadcrumbs :items="[
                ['label' => 'Quem Somos', 'url' => route('about.index')],
                ['label' => 'Notícias', 'url' => route('posts.index')],
                ['label' => $post->title],
            ]" />
            <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 uppercase mt-1">{{ $post->title }}</h1>
            <p class="text-xs font-semibold text-gray-400 mt-1">Publicado em
                {{ \Carbon\Carbon::parse($post->published_at ?? $post->created_at)->format('d \d\e F, Y') }}</p>
        </div>
    </div>

    <section class="py-6 md:py-12 bg-white w-full">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                <!-- Left Column (Post details) -->
                <div class="lg:col-span-8 space-y-8">
                    @if ($post->image)
                        <div class="w-full aspect-[21/9] overflow-hidden border border-gray-100 bg-gray-50">
                            <img src="{{ asset(str_starts_with($post->image, 'uploads/') ? $post->image : 'storage/' . $post->image) }}"
                                alt="{{ $post->title }}" class="w-full h-full object-cover">
                        </div>
                    @endif

                    <!-- Excerpt / Intro -->
                    @if($post->excerpt)
                        <div class="p-5 bg-green-50/60 border-l-4 border-[#45B500] text-gray-800 font-semibold text-base leading-relaxed italic">
                            {{ $post->excerpt }}
                        </div>
                    @endif

                    <!-- Rich Content (CKEditor Output) -->
                    <div class="rich-content text-gray-700 leading-relaxed text-sm md:text-base space-y-4">
                        {!! $post->content !!}
                    </div>

                    <!-- Lightbox Gallery Section -->
                    @if(is_array($post->gallery) && count($post->gallery) > 0)
                        <div class="pt-8 border-t border-gray-100 space-y-4">
                            <h3 class="text-xl font-extrabold text-gray-900 uppercase flex items-center gap-2">
                                <i class="fas fa-images text-[#45B500]"></i> Galeria de Fotografias
                            </h3>
                            <p class="text-xs text-gray-500">Clique em qualquer fotografia para abrir a visualização em ecrã inteiro (Lightbox).</p>
                            
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 pt-2">
                                @foreach($post->gallery as $gIndex => $gPath)
                                    <a href="{{ asset($gPath) }}" class="glightbox block overflow-hidden aspect-[4/3] border border-gray-100 transition-all duration-300 group relative bg-gray-50" data-gallery="post-gallery" data-title="{{ $post->title }} - Foto {{ $gIndex + 1 }}">
                                        <img src="{{ asset($gPath) }}" alt="Fotografia {{ $gIndex + 1 }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                                            <span class="w-10 h-10 rounded-full bg-white/90 text-gray-900 flex items-center justify-center shadow-lg transform scale-90 group-hover:scale-100 transition-transform">
                                                <i class="fas fa-magnifying-glass-plus text-sm text-[#45B500]"></i>
                                            </span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="pt-8 border-t border-gray-100">
                        <a href="{{ route('posts.index') }}"
                            class="text-[#45B500] font-bold hover:underline text-sm inline-flex items-center gap-2">
                            &larr; Voltar para todas as notícias
                        </a>
                    </div>
                </div>

                <!-- Right Column (Sidebar with recent articles) -->
                <div class="lg:col-span-4 space-y-8">
                    <div class="bg-gray-50/50 p-6 border border-gray-100 space-y-6">
                        <h3 class="font-extrabold text-gray-900 text-sm border-b border-gray-200 pb-3 uppercase">Artigos Recentes</h3>

                        <div class="space-y-4">
                            @forelse($recentPosts as $recent)
                                <a href="{{ route('posts.show', $recent->slug) }}"
                                    class="flex items-center gap-3 group">
                                    <div
                                        class="w-14 h-14 overflow-hidden bg-gray-100 flex-shrink-0 border border-gray-100">
                                        @if ($recent->image)
                                            <img src="{{ asset(str_starts_with($recent->image, 'uploads/') ? $recent->image : 'storage/' . $recent->image) }}"
                                                class="w-full h-full object-cover" alt="{{ $recent->title }}">
                                        @else
                                            <img src="{{ asset('placeholder.png') }}"
                                                class="w-full h-full object-cover" alt="{{ $recent->title }}">
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <h4
                                            class="font-bold text-gray-900 text-xs line-clamp-2 leading-snug group-hover:text-[#45B500] transition-colors">
                                            {{ $recent->title }}
                                        </h4>
                                        <span class="text-[10px] text-gray-400 font-semibold mt-1 block">
                                            {{ \Carbon\Carbon::parse($recent->published_at ?? $recent->created_at)->format('d/m/Y') }}
                                        </span>
                                    </div>
                                </a>
                            @empty
                                <p class="text-xs text-gray-400">Nenhum outro artigo recente.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Include GLightbox CSS & JS -->
    <x-slot:scripts>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof GLightbox !== 'undefined') {
                    const lightbox = GLightbox({
                        selector: '.glightbox',
                        touchNavigation: true,
                        loop: true,
                        zoomable: true
                    });
                }
            });
        </script>
    </x-slot:scripts>
</x-frontend.layout>
