@props(['store'])

<a href="{{ route('stores.show', $store) }}" class="flex flex-col rounded-[12px] hover-scale-card overflow-hidden shadow-sm bg-white border border-gray-100">
    <div class="p-6">
        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $store->name }}</h3>
        <p class="text-gray-600 mb-4">{{ $store->address }}</p>
        <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-semibold {{ $store->status === 'Aberta' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
            <span class="w-1.5 h-1.5 rounded-full {{ $store->status === 'Aberta' ? 'bg-green-500' : 'bg-red-500' }}"></span>
            {{ $store->status }}
        </span>
    </div>
</a>
