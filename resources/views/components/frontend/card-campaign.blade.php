@props(['campaign'])

<a href="{{ route('campaigns.show', $campaign) }}" class="flex flex-col rounded-[12px] hover-scale-card overflow-hidden shadow-sm bg-white border border-gray-100 group">
    <div class="aspect-video w-full overflow-hidden">
        <img src="{{ $campaign->image ? asset(str_starts_with($campaign->image, 'uploads/') ? $campaign->image : 'storage/'.$campaign->image) : asset('assets/img/hero.png') }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
    </div>
    <div class="p-5">
        <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-[#45B500] transition-colors">{{ $campaign->title }}</h3>
        @if($campaign->link)
            <span class="text-[#45B500] font-semibold text-sm inline-flex items-center gap-1 mt-2">
                Saber Mais
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </span>
        @endif
    </div>
</a>
