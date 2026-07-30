<x-frontend.layout>
    <x-slot:meta_title>{{ $campaign->title }} - Ofertas Fresmart</x-slot>
    <x-slot:meta_description>{{ Str::limit(strip_tags($campaign->title), 150) }}</x-slot>
    @if ($campaign->image)
        <x-slot:meta_image>{{ str_starts_with($campaign->image, 'uploads/') ? $campaign->image : 'storage/' . $campaign->image }}</x-slot>
    @endif

    <div class="bg-white py-8 md:py-12">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10 space-y-6">
            <x-frontend.breadcrumbs :items="[['label' => 'Ofertas & Folhetos', 'url' => route('campaigns.index')], ['label' => $campaign->title]]" />

            <!-- Imagem de Oferta em Tamanho Inteiro (100% Width, Height Automática Sem Distorção) -->
            <div class="w-full rounded-[24px] overflow-hidden shadow-sm border border-gray-100 bg-white">
                <img src="{{ $campaign->image ? asset(str_starts_with($campaign->image, 'uploads/') ? $campaign->image : 'storage/' . $campaign->image) : asset('assets/img/hero.png') }}"
                    alt="{{ $campaign->title }}"
                    class="w-full h-auto object-contain block">
            </div>

            <div class="pt-4 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-2xl md:text-4xl font-extrabold text-gray-900 leading-tight mb-2">{{ $campaign->title }}</h1>
                </div>

                @if ($campaign->link)
                    <div class="flex-shrink-0">
                        <a href="{{ $campaign->link }}" target="_blank"
                            class="inline-flex items-center gap-2 bg-[#45B500] hover:bg-[#3a9900] text-white font-extrabold py-3.5 px-8 rounded-2xl shadow-md transition-all duration-300 text-sm uppercase tracking-wider">
                            Aproveitar Oferta <i class="fas fa-external-link-alt text-xs"></i>
                        </a>
                    </div>
                @endif
            </div>

            <div class="pt-6 border-t border-gray-100">
                <a href="{{ route('campaigns.index') }}"
                    class="text-sm font-bold text-[#45B500] hover:underline uppercase tracking-wider inline-flex items-center gap-2">
                    &larr; Voltar para todas as ofertas
                </a>
            </div>
        </div>
    </div>
</x-frontend.layout>
