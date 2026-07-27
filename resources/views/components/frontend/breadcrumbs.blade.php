@props(['items' => []])

<nav class="flex items-center flex-wrap gap-2 text-xs font-semibold text-gray-500 py-2">
    <a href="{{ route('home') }}" class="hover:text-[#45B500] transition-colors">Início</a>
    @foreach ($items as $item)
        <span class="text-gray-300 font-normal">/</span>
        @if (isset($item['url']) && !$loop->last)
            <a href="{{ $item['url'] }}" class="hover:text-[#45B500] transition-colors">{{ $item['label'] }}</a>
        @else
            <span class="text-gray-800">{{ $item['label'] }}</span>
        @endif
    @endforeach
</nav>
