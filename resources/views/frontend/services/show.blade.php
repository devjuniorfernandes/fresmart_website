<x-frontend.layout>
    <x-slot:meta_title>{{ $service->name }} - Serviços Fresmart</x-slot>
    <x-slot:meta_description>{{ Str::limit(strip_tags($service->description), 150) }}</x-slot>
    @if ($service->image)
        <x-slot:meta_image>{{ str_starts_with($service->image, 'uploads/') ? $service->image : 'storage/' . $service->image }}</x-slot>
    @endif

    <!-- Banner Cover Image (Single) -->
    @if ($service->image)
        <div class="relative w-full h-[300px] md:h-[380px] bg-gray-900 overflow-hidden">
            <img src="{{ asset(str_starts_with($service->image, 'uploads/') ? $service->image : 'storage/' . $service->image) }}"
                alt="{{ $service->name }}" class="w-full h-full object-cover">
            <!-- Smooth Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
            <!-- Title Content Overlay -->
            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none text-center px-4 z-20">
                <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-wider drop-shadow-lg uppercase">
                    {{ $service->name }}</h1>
                <p class="text-xs md:text-sm font-semibold text-white/90 tracking-wide mt-2 drop-shadow-md">Serviços Fresmart</p>
            </div>
        </div>
    @else
        <!-- Fallback if no banner image exists -->
        <div class="bg-[#45B500] py-16 text-center text-white">
            <h1 class="text-3xl font-extrabold uppercase">{{ $service->name }}</h1>
            <p class="text-xs font-semibold text-white/90 mt-2">Serviços Fresmart</p>
        </div>
    @endif

    <!-- Content Area inside standard page container -->
    <section class="py-16 md:py-24 bg-white w-full">
        <div class="w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[900px] mx-auto">
            <div class="bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-gray-100 space-y-8">
                <!-- Rich formatted description content -->
                <div class="rich-content text-gray-700 text-sm md:text-base leading-relaxed">
                    {!! $service->description ?? '<p class="text-gray-500">Nenhuma descrição fornecida para este serviço.</p>' !!}
                </div>

                <!-- Optional Additional Image (after description paragraph) -->
                @if ($service->additional_image)
                    <div class="my-8 rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                        <img src="{{ asset($service->additional_image) }}" alt="Imagem complementar do serviço"
                            class="w-full h-auto object-cover max-h-[500px]">
                    </div>
                @endif

                <!-- Optional CTA Action Button (with internal/external URL or PDF Download) -->
                @if ($service->btn_text && $service->btn_link)
                    @php
                        $isPdf = str_ends_with(strtolower($service->btn_link), '.pdf');
                    @endphp
                    <div class="pt-6 flex justify-center">
                        <a href="{{ asset($service->btn_link) }}"
                            @if (str_starts_with($service->btn_link, 'http') || $isPdf) target="_blank" @endif
                            @if ($isPdf) download @endif
                            class="inline-flex items-center gap-2.5 bg-[#45B500] hover:bg-[#3b9b18] text-white font-extrabold text-sm px-8 py-3.5 rounded-xl transition-all duration-300 shadow hover:shadow-md transform hover:-translate-y-0.5 cursor-pointer">
                            @if($isPdf)
                                <i class="far fa-file-pdf text-base"></i>
                            @endif
                            {{ $service->btn_text }}
                        </a>
                    </div>
                @endif
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('services.index') }}" class="text-[#45B500] font-bold hover:underline text-sm inline-flex items-center gap-2">
                    &larr; Voltar para todos os serviços
                </a>
            </div>
        </div>
    </section>
</x-frontend.layout>
