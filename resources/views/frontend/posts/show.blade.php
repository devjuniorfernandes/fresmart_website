<x-frontend.layout>
    <x-slot:meta_title>{{ $post->title }} - Notícias Fresmart</x-slot>
    <x-slot:meta_description>{{ Str::limit(strip_tags($post->content), 150) }}</x-slot>
    @if ($post->image)
        <x-slot:meta_image>{{ str_starts_with($post->image, 'uploads/') ? $post->image : 'storage/' . $post->image }}</x-slot>
    @endif

    <div class="bg-white border-b border-gray-100 py-6">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
            <x-frontend.breadcrumbs :items="[['label' => 'Quem Somos', 'url' => route('about.index')], ['label' => 'Notícias', 'url' => route('posts.index')], ['label' => $post->title]]" />
            <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 uppercase mt-1">{{ $post->title }}</h1>
            <p class="text-xs font-semibold text-gray-400 mt-1">Publicado em {{ \Carbon\Carbon::parse($post->published_at ?? $post->created_at)->format('d \d\e F, Y') }}</p>
        </div>
    </div>

    <section class="py-16 md:py-24 bg-white w-full">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Left Column (Post details) -->
                <div class="lg:col-span-8 space-y-8">
                    @if($post->image)
                        <div class="w-full aspect-[21/9] overflow-hidden border border-gray-100 bg-gray-50">
                            <img src="{{ asset(str_starts_with($post->image, 'uploads/') ? $post->image : 'storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                        </div>
                    @endif

                    <div class="prose max-w-none text-gray-700 leading-relaxed text-sm md:text-base space-y-4">
                        {!! $post->content !!}
                    </div>

                    <div class="pt-8 border-t border-gray-100">
                        <a href="{{ route('posts.index') }}" class="text-[#45B500] font-bold hover:underline text-sm inline-flex items-center gap-2">
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
                                <a href="{{ route('posts.show', $recent->slug) }}" class="flex items-center gap-3 group">
                                    <div class="w-14 h-14 overflow-hidden bg-gray-100 flex-shrink-0 border border-gray-100">
                                        @if($recent->image)
                                            <img src="{{ asset(str_starts_with($recent->image, 'uploads/') ? $recent->image : 'storage/' . $recent->image) }}" class="w-full h-full object-cover" alt="{{ $recent->title }}">
                                        @else
                                            <img src="{{ asset('assets/img/slider1.png') }}" class="w-full h-full object-cover" alt="{{ $recent->title }}">
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="font-bold text-gray-900 text-xs line-clamp-2 leading-snug group-hover:text-[#45B500] transition-colors">
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
</x-frontend.layout>
