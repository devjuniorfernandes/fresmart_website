<x-frontend.layout>
    <x-slot:meta_title>{{ $campaign->title }} - Ofertas Fresmart</x-slot>
    <x-slot:meta_description>{{ Str::limit(strip_tags($campaign->description), 150) }}</x-slot>
    @if ($campaign->image)
        <x-slot:meta_image>{{ str_starts_with($campaign->image, 'uploads/') ? $campaign->image : 'storage/' . $campaign->image }}</x-slot>
    @endif
    <x-frontend.page-header :title="$campaign->title" subtitle="Ofertas Exclusivas Fresmart" :image="$campaign->image
        ? (str_starts_with($campaign->image, 'uploads/')
            ? $campaign->image
            : 'storage/' . $campaign->image)
        : 'assets/img/Ofertas Imperdíveis.jpg'" />

    <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
        <div class="aspect-video w-full">
            <img src="{{ $campaign->image ? asset(str_starts_with($campaign->image, 'uploads/') ? $campaign->image : 'storage/' . $campaign->image) : asset('assets/img/Untitled-2 copy.jpg') }}"
                alt="{{ $campaign->title }}" class="w-full h-full object-cover">
        </div>
        <div class="p-8 md:p-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">{{ $campaign->title }}</h2>

            @if ($campaign->link)
                <div class="my-8">
                    <a href="{{ $campaign->link }}" target="_blank"
                        class="btn-primary bg-[#45B500] inline-block hover:bg-[#3a9900] text-white font-bold py-4 px-10 rounded-xl text-center shadow-lg hover:shadow-xl transition-all duration-300 text-lg">
                        Aproveitar Oferta
                    </a>
                </div>
            @endif

            <div class="mt-12 pt-8 border-t border-gray-100">
                <a href="{{ route('campaigns.index') }}"
                    class="text-[#45B500] font-bold hover:underline inline-flex items-center gap-2">
                    &larr; Voltar para Todas as Ofertas
                </a>
            </div>
        </div>
    </div>
</x-frontend.layout>
