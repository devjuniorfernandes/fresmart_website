@props(['title', 'subtitle' => null, 'image' => null])

<div class="relative w-full h-[250px] md:h-[300px] bg-gray-900 flex items-center justify-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="{{ $image ? asset($image) : asset('assets/img/slider1.png') }}" alt="{{ $title }}" class="w-full h-full object-cover object-center opacity-60">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto mt-10">
        <h1 class="text-4xl md:text-5xl font-bold text-white uppercase tracking-wider shadow-sm">{{ $title }}</h1>
        @if($subtitle)
            <p class="mt-4 text-lg md:text-xl text-white/90 font-light">{{ $subtitle }}</p>
        @endif
    </div>
</div>
