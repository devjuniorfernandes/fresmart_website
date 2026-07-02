@props(['service'])

<a href="{{ route('services.show', $service) }}" class="block rounded-[16px] overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300 group relative">
    <div class="w-full aspect-[16/10] md:aspect-[4/3]">
        <img src="{{ $service->image ? asset(str_starts_with($service->image, 'uploads/') ? $service->image : 'storage/'.$service->image) : asset('assets/img/frescafe.jpg') }}" alt="{{ $service->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
    </div>
    
    @if($service->show_title)
        <!-- Subtle gradient overlay to guarantee text legibility -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/15 to-transparent opacity-90 group-hover:opacity-95 transition-opacity duration-300"></div>
        <div class="absolute bottom-5 left-5 right-5">
            <h3 class="text-base md:text-lg font-bold text-white leading-tight uppercase tracking-wider">{{ $service->name }}</h3>
        </div>
    @else
        <span class="sr-only">{{ $service->name }}</span>
    @endif
</a>
