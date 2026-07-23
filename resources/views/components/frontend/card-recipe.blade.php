@props(['recipe'])

<a href="{{ route('recipes.show', $recipe) }}" class="flex flex-col flex-shrink-0 animate-on-scroll rounded-[24px] border border-gray-100 p-3 bg-white shadow-sm hover:shadow-md transition-all duration-300 group h-full">
    <div class="h-[200px] w-full relative rounded-[16px] overflow-hidden">
        <img src="{{ $recipe->image ? asset(str_starts_with($recipe->image, 'uploads/') ? $recipe->image : 'storage/'.$recipe->image) : asset('assets/img/receita1.jpg') }}" alt="{{ $recipe->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
        
        @if($recipe->category)
        <div class="absolute top-3 left-3 bg-[#F5A623] text-white text-[11px] font-bold px-3 py-1 rounded-full shadow-sm">
            {{ $recipe->category }}
        </div>
        @endif
    </div>
    <div class="pt-4 px-2 pb-2 flex flex-col flex-grow text-left">
        <h3 class="text-[#1A1A1A] text-[17px] font-bold leading-snug group-hover:text-[#45B500] transition-colors line-clamp-2">{{ $recipe->title }}</h3>
        
        <p class="text-[13px] text-gray-500 font-medium leading-tight mt-2 mb-4 flex items-center gap-1.5 flex-wrap">
            <span class="inline-flex items-center gap-1"><i class="far fa-clock text-[#45B500]"></i> {{ $recipe->prep_time_minutes ?? '30' }} min</span>
            <span class="text-gray-300">|</span>
            <span class="inline-flex items-center gap-1"><i class="fas fa-utensils text-[#45B500]"></i> {{ $recipe->portions ?? '4' }} porções</span>
        </p>

        <div class="mt-auto">
            <span class="inline-block border border-gray-200 bg-white text-[#1A1A1A] text-[12px] font-bold px-4 py-1.5 rounded-full group-hover:border-[#45B500] group-hover:text-[#45B500] transition-colors shadow-sm">
                {{ __('Shop Recipe') }}
            </span>
        </div>
    </div>
</a>
