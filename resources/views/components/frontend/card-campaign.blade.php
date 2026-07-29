@props(['campaign', 'height' => 'h-[340px] md:h-[420px]'])

@php
    $imgUrl = $campaign->image ? (str_starts_with($campaign->image, 'http') ? $campaign->image : (str_starts_with($campaign->image, 'uploads/') ? asset($campaign->image) : asset('storage/'.$campaign->image))) : asset('assets/img/hero.png');
    $targetUrl = $campaign->link ?: route('campaigns.show', $campaign);
    $showTitle = isset($campaign->show_title) ? (bool)$campaign->show_title : (isset($campaign->show_text) ? (bool)$campaign->show_text : true);
    $showButton = isset($campaign->show_button) ? (bool)$campaign->show_button : true;
@endphp

<a href="{{ $targetUrl }}" class="relative block w-full {{ $height }} rounded-[24px] overflow-hidden shadow-sm border border-gray-100 group transition-transform duration-300 hover:scale-[1.01]">
    <!-- Background Image -->
    <img src="{{ $imgUrl }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">

    <!-- Content Overlay -->
    @if($showTitle || $showButton)
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent p-4 sm:p-5 lg:p-6 flex flex-col justify-end items-start text-white">
            @if($showTitle && $campaign->title)
                <h3 class="text-sm sm:text-base lg:text-xl font-extrabold tracking-tight drop-shadow-md text-white mb-2 leading-snug line-clamp-2">
                    {{ $campaign->title }}
                </h3>
            @endif

            @if($showButton)
                <span class="inline-flex items-center gap-1.5 bg-white text-gray-900 font-extrabold text-[11px] sm:text-xs lg:text-sm px-4 lg:px-5 py-2 lg:py-2.5 rounded-full shadow-md hover:bg-gray-100 transition-all mt-1 group-hover:bg-[#45B500] group-hover:text-white">
                    Ver Oferta <i class="fas fa-arrow-right text-[9px] lg:text-[10px]"></i>
                </span>
            @endif
        </div>
    @endif
</a>
