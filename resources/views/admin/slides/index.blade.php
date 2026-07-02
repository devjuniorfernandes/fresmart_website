<x-admin-layout>
    <x-slot:header>Slides (Capa)</x-slot>
    <x-slot:actions>
        <a href="{{ route('admin.slides.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg shadow-sm transition-all duration-200 text-sm">Adicionar Novo</a>
    </x-slot>

    <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-[13px]">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/50">
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/4">Imagem</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Título / Subtítulo</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/6">Estado</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/6">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($slides as $slide)
                        <tr class="border-b border-gray-50 hover:bg-gray-50 group transition-colors duration-150">
                            <td class="py-4 px-4 align-top">
                                <img src="{{ asset(str_starts_with($slide->image, 'uploads/') ? $slide->image : 'storage/'.$slide->image) }}" class="h-16 w-32 object-cover rounded-md border border-gray-200">
                            </td>
                            <td class="py-4 px-4 align-top">
                                <strong class="text-slate-800 text-sm block mb-1">{{ $slide->title ?: '(Sem título)' }}</strong>
                                <span class="text-green-600">{{ $slide->subtitle }}</span>
                            </td>
                            <td class="py-4 px-4 align-top">
                                @if($slide->is_active)
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-md text-xs font-semibold">Ativo</span>
                                @else
                                    <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-md text-xs font-semibold">Inativo</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 align-top">
                                <a href="{{ route('admin.slides.edit', $slide->id) }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors mr-2">Editar</a>
                                <form action="{{ route('admin.slides.destroy', $slide->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem a certeza?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition-colors">Apagar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="py-6 px-4 text-center text-gray-500">Nenhum slide encontrado.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>