<x-admin-layout>
    <x-slot:header>Notícias e Eventos (Blog)</x-slot>
    <x-slot:actions>
        <a href="{{ route('admin.posts.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg shadow-sm transition-all duration-200 text-sm">Nova Notícia</a>
    </x-slot>

    <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-[13px]">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/50">
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/4">Imagem</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Título / Excert</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/6">Publicado em</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/6">Estado</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/6">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr class="border-b border-gray-50 hover:bg-gray-50 group transition-colors duration-150">
                            <td class="py-4 px-4 align-top">
                                @if($post->image)
                                    <img src="{{ asset(str_starts_with($post->image, 'uploads/') ? $post->image : 'storage/'.$post->image) }}" class="h-16 w-32 object-cover rounded-md border border-gray-200">
                                @else
                                    <div class="h-16 w-32 rounded-md border border-gray-200 bg-gray-50 flex items-center justify-center text-gray-400">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="py-4 px-4 align-top">
                                <strong class="text-slate-800 text-sm block mb-1">{{ $post->title }}</strong>
                                <span class="text-gray-500 line-clamp-2 text-xs leading-normal">{{ $post->excerpt ?: Str::limit(strip_tags($post->content), 100) }}</span>
                            </td>
                            <td class="py-4 px-4 align-top text-gray-600">
                                {{ $post->published_at ? $post->published_at->format('d/m/Y H:i') : '-' }}
                            </td>
                            <td class="py-4 px-4 align-top">
                                @if($post->is_active)
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-md text-xs font-semibold">Ativo</span>
                                @else
                                    <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-md text-xs font-semibold">Inativo</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 align-top">
                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors mr-2">Editar</a>
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem a certeza?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition-colors">Apagar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-6 px-4 text-center text-gray-500">Nenhuma notícia encontrada.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($posts->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
