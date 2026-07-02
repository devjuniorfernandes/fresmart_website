<x-admin-layout>
    <x-slot:header>
        Lojas
    </x-slot>
    <x-slot:actions>
        <a href="{{ route('admin.stores.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg shadow-sm transition-all duration-200 text-sm">Adicionar Nova</a>
    </x-slot>

    <!-- WP Style Table -->
    <div class="bg-white border border-gray-50 shadow-md rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-[13px]">
                <thead>
                    <tr class="border-b border-gray-50 bg-gray-50/50">
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/4">Nome</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Endereço</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/6">Cidade / Bairro</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/6">Status</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/6">Data</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/6">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stores ?? [] as $store)
                        <tr class="border-b border-gray-50 hover:bg-[#f6f7f7] group">
                            <td class="py-4 px-4 align-top">
                                <strong class="text-[#2271b1] text-sm block mb-1">{{ $store->name }}</strong>
                                <div class="opacity-0 group-hover:opacity-100 transition text-[12px]">
                                    <a href="{{ route('admin.stores.edit', $store->id) }}" class="text-[#2271b1] hover:underline">Editar</a> | 
                                    <form action="{{ route('admin.stores.destroy', $store->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-[#d63638] hover:underline cursor-pointer" onclick="return confirm('Mover para lixo?')">Lixeira</button>
                                    </form>
                                </div>
                            </td>
                            <td class="py-4 px-4 align-top text-[#50575e]">{{ $store->address }}</td>
                            <td class="py-4 px-4 align-top text-[#50575e]">{{ $store->city }} / {{ $store->bairro }}</td>
                            <td class="py-4 px-4 align-top text-[#50575e]">{{ $store->status }}</td>
                            <td class="py-4 px-4 align-top text-[#50575e]">
                                Publicado<br>
                                {{ $store->created_at->format('d/m/Y') }}
                            </td>
                            <td class="py-4 px-4 align-top">
                                <a href="{{ route('admin.stores.edit', $store->id) }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors mr-2">Editar</a>
                                <form action="{{ route('admin.stores.destroy', $store->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem a certeza?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition-colors">Apagar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 px-3 text-center text-gray-500">Nenhuma loja encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3 border-t border-[#c3c4c7] bg-[#f6f7f7]">
            <span class="text-[13px] text-[#50575e]">{{ count($stores ?? []) }} itens</span>
        </div>
    </div>
</x-admin-layout>
