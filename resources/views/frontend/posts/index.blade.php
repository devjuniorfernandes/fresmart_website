<x-frontend.layout>
    <x-frontend.page-header 
        title="Notícias & Eventos" 
        subtitle="Fique por dentro das novidades, eventos e dicas da Fresmart"
        image="assets/img/slider1.png" />

    <section class="py-16 md:py-24 bg-gray-50/50 w-full min-h-[60vh]">
        <div class="w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[1528px] mx-auto">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($posts as $post)
                    <article class="bg-white border border-gray-100 rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Post Thumbnail -->
                            <div class="relative overflow-hidden aspect-[16/10] bg-gray-50 border-b border-gray-50">
                                @if($post->image)
                                    <img src="{{ asset(str_starts_with($post->image, 'uploads/') ? $post->image : 'storage/' . $post->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $post->title }}">
                                @else
                                    <img src="{{ asset('assets/img/slider1.png') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $post->title }}">
                                @endif
                            </div>

                            <!-- Post Info -->
                            <div class="p-6 space-y-3">
                                <div class="flex items-center gap-3 text-[11px] font-bold text-gray-400 uppercase">
                                    <span class="text-[#45B500]"><i class="far fa-newspaper"></i> Novidades</span>
                                    <span>•</span>
                                    <span>{{ \Carbon\Carbon::parse($post->published_at ?? $post->created_at)->format('d \d\e F, Y') }}</span>
                                </div>
                                
                                <h3 class="font-extrabold text-gray-900 text-base sm:text-lg leading-snug line-clamp-2 group-hover:text-[#45B500] transition-colors">
                                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                </h3>
                                
                                <p class="text-xs text-gray-500 line-clamp-3 leading-relaxed">
                                    {{ strip_tags(html_entity_decode($post->content)) }}
                                </p>
                            </div>
                        </div>

                        <!-- Read More CTA -->
                        <div class="p-6 pt-0">
                            <a href="{{ route('posts.show', $post->slug) }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#45B500] hover:text-[#3b9b18] uppercase tracking-wider transition-colors">
                                Ler Artigo Completo <i class="fas fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full bg-white rounded-3xl p-16 text-center border border-gray-100 shadow-sm">
                        <i class="far fa-newspaper text-4xl text-gray-300 mb-3 block"></i>
                        <p class="text-gray-500 font-semibold text-sm">Ainda não existem notícias ou eventos publicados.</p>
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
