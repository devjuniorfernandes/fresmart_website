<x-frontend.layout>
    <div class="bg-white border-b border-gray-100 py-6">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
            <x-frontend.breadcrumbs :items="[['label' => 'Quem Somos', 'url' => route('about.index')], ['label' => 'Notícias']]" />
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 uppercase mt-1">
                {{ $page->title ?? 'Notícias & Eventos' }}</h1>
            <p class="text-sm text-gray-500 mt-1">
                {{ $page->subtitle ?? 'Fique por dentro das novidades, eventos e dicas da Fresmart' }}
            </p>
        </div>
    </div>

    <section class="bg-white w-full min-h-[60vh]">
        <div class="max-w-[1528px] mx-auto mt-6 px-6 lg:px-10">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($posts as $post)
                    <article
                        class="bg-white border border-gray-100 overflow-hidden transition-all duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Post Thumbnail -->
                            <div class="relative overflow-hidden aspect-[16/10] bg-gray-50 border-b border-gray-50">
                                @if ($post->image)
                                    <img src="{{ asset(str_starts_with($post->image, 'uploads/') ? $post->image : 'storage/' . $post->image) }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        alt="{{ $post->title }}">
                                @else
                                    <img src="{{ asset('placeholder.png') }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        alt="{{ $post->title }}">
                                @endif
                            </div>

                            <!-- Post Info -->
                            <div class="p-6 space-y-3">
                                <div class="flex items-center gap-3 text-[11px] font-bold text-gray-400 uppercase">
                                    <span class="text-[#45B500]">Novidades</span>
                                    <span>•</span>
                                    <span>{{ \Carbon\Carbon::parse($post->published_at ?? $post->created_at)->format('d \d\e F, Y') }}</span>
                                </div>

                                <h3
                                    class="font-extrabold text-gray-900 text-base sm:text-lg leading-snug line-clamp-2 group-hover:text-[#45B500] transition-colors">
                                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                </h3>

                                <p class="text-xs text-gray-500 line-clamp-3 leading-relaxed">
                                    {{ strip_tags(html_entity_decode($post->content)) }}
                                </p>
                            </div>
                        </div>

                        <!-- Read More CTA -->
                        <div class="p-6 pt-0">
                            <a href="{{ route('posts.show', $post->slug) }}"
                                class="inline-flex items-center gap-1 text-xs font-bold text-[#45B500] hover:text-[#3b9b18] uppercase tracking-wider transition-colors">
                                Ler Artigo Completo
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full bg-white p-16 text-center border border-gray-100 shadow-sm">
                        <p class="text-gray-500 font-semibold text-sm">Ainda não existem notícias ou eventos publicados.
                        </p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $posts->links() }}
            </div>

        </div>
    </section>
</x-frontend.layout>
