<x-frontend.layout>
    <x-slot:meta_title>{{ $service->name }} - Serviços Fresmart</x-slot>
    <x-slot:meta_description>{{ Str::limit(strip_tags($service->description), 150) }}</x-slot>
    @if ($service->image)
        <x-slot:meta_image>{{ str_starts_with($service->image, 'uploads/') ? $service->image : 'storage/' . $service->image }}</x-slot>
    @endif

    <!-- Banner Cover Image (Single) -->
    @if ($service->image)
        <div class="relative w-full h-[360px] md:h-[450px] bg-gray-900 overflow-hidden">
            <img src="{{ asset(str_starts_with($service->image, 'uploads/') ? $service->image : 'storage/' . $service->image) }}"
                alt="{{ $service->name }}" class="w-full h-full object-cover">
            <!-- Smooth Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
            <!-- Title Content Overlay -->
            <div
                class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none text-center px-4 z-20">
                <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-wider drop-shadow-lg uppercase">
                    {{ $service->name }}</h1>
                <p class="text-sm md:text-base font-semibold text-white/95 tracking-wide mt-2 drop-shadow-md">Serviços
                    Fresmart</p>
            </div>
        </div>
    @else
        <!-- Fallback if no banner image exists -->
        <div class="bg-[#45B500] py-16 text-center text-white">
            <h1 class="text-4xl font-extrabold uppercase">{{ $service->name }}</h1>
            <p class="text-sm font-semibold text-white/90 mt-2">Serviços Fresmart</p>
        </div>
    @endif

    <!-- Content Area -->
    <div class="bg-white rounded-2xl p-8 md:p-12 shadow-sm border border-gray-100">
        <!-- Rich formatted description content -->
        <div class="rich-content text-gray-700 text-lg leading-relaxed mb-8">
            {!! $service->description ?? '<p class="text-gray-500">Nenhuma descrição fornecida para este serviço.</p>' !!}
        </div>

        <!-- Optional Additional Image (after description paragraph) -->
        @if ($service->additional_image)
            <div class="my-10 mx-auto rounded-2xl overflow-hidden">
                <img src="{{ asset($service->additional_image) }}" alt="Imagem complementar do serviço"
                    class="w-full h-auto object-cover max-h-[550px] mx-auto">
            </div>
        @endif

        <!-- Optional CTA Action Button (with internal/external URL) -->
        @if ($service->btn_text && $service->btn_link)
            <div class="mt-8 flex justify-center">
                <a href="{{ $service->btn_link }}"
                    @if (str_starts_with($service->btn_link, 'http')) target="_blank" rel="noopener noreferrer" @endif
                    class="inline-block bg-[#45B500] hover:bg-[#3b9b18] text-white font-bold text-lg px-10 py-4 rounded-xl transition-all duration-300 transform hover:-translate-y-0.5">
                    {{ $service->btn_text }}
                </a>
            </div>
        @endif
    </div>
</x-frontend.layout>
