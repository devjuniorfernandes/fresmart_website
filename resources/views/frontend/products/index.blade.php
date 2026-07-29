<x-frontend.layout>
    <x-frontend.page-header 
        title="{{ $page->title ?? ($settings->banner_products_title ?: 'Nossos Produtos') }}" 
        subtitle="{{ $page->subtitle ?? ($settings->banner_products_subtitle ?: 'Conheça a frescura e qualidade dos nossos departamentos') }}"
        image="{{ ($page && $page->banner_image) ? asset($page->banner_image) : ($settings->banner_products_image ? asset($settings->banner_products_image) : asset('assets/img/hero.png')) }}" />

    <section class="py-12 max-w-[1528px] mx-auto px-6 lg:px-10 min-h-[50vh]">
        <x-frontend.breadcrumbs :items="[['label' => 'Produtos']]" />
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($products as $product)
                <a href="{{ route('products.show', $product) }}" class="block rounded-[24px] overflow-hidden transition-all duration-300 group relative border border-gray-100 shadow-sm hover:shadow-xl hover:scale-[1.01]">
                    <div class="w-full aspect-[16/10] md:aspect-[4/3]">
                        <img src="{{ $product->image ? asset(str_starts_with($product->image, 'uploads/') ? $product->image : 'storage/'.$product->image) : asset('placeholder.png') }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    
                    @if($product->show_title)
                        <!-- Subtle gradient overlay to guarantee text legibility -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/15 to-transparent opacity-90 group-hover:opacity-95 transition-opacity duration-300"></div>
                        <div class="absolute bottom-5 left-5 right-5">
                            <h3 class="text-base md:text-lg font-bold text-white leading-tight uppercase tracking-wider">{{ $product->name }}</h3>
                        </div>
                    @else
                        <span class="sr-only">{{ $product->name }}</span>
                    @endif
                </a>
            @empty
                <div class="col-span-full text-center py-20 text-gray-500 text-xl">Nenhuma categoria de produto cadastrada.</div>
            @endforelse
        </div>
    </section>
</x-frontend.layout>
