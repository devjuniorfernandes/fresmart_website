<x-frontend.layout>
    <x-slot:meta_title>{{ $service->name }} - Serviços Fresmart</x-slot>
    <x-slot:meta_description>{{ Str::limit(strip_tags($service->description), 150) }}</x-slot>
    @if($service->image)
        <x-slot:meta_image>{{ str_starts_with($service->image, 'uploads/') ? $service->image : 'storage/' . $service->image }}</x-slot>
    @endif
    <x-frontend.page-header :title="$service->name" subtitle="Serviços Fresmart" :image="$service->image ? (str_starts_with($service->image, 'uploads/') ? $service->image : 'storage/'.$service->image) : 'assets/img/frescafe.jpg'" />

    <section class="py-20 w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[1200px] mx-auto min-h-[50vh]">
        <div class="bg-white rounded-2xl p-8 md:p-12 shadow-sm border border-gray-100">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8">{{ $service->name }}</h2>
            
            <div class="prose max-w-none text-gray-700 text-lg leading-relaxed whitespace-pre-line">
                {{ $service->description ?? 'Nenhuma descrição fornecida para este serviço.' }}
            </div>
            
            <div class="mt-12 pt-8 border-t border-gray-100">
                <a href="{{ route('services.index') }}" class="btn-primary bg-[#45B500] inline-block hover:bg-[#3a9900] text-white font-bold py-3 px-8 rounded-xl text-center shadow-lg hover:shadow-xl transition-all duration-300">
                    &larr; Voltar para Serviços
                </a>
            </div>
        </div>
    </section>
</x-frontend.layout>
