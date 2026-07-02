<x-admin-layout>
    <x-slot:header>Campanhas</x-slot>
    <x-slot:actions>
        <a href="{{ route('admin.campaigns.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg shadow-sm transition-all duration-200 text-sm">Adicionar Nova</a>
    </x-slot>
    <div class="bg-white border border-gray-50 shadow-md rounded-xl overflow-hidden">
        <table class="w-full text-left text-[13px]">
            <thead>
                <tr class="border-b border-gray-50 bg-gray-50/50">
                    <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Título</th>
                    <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Status</th>
                    <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Data</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/6">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($campaigns ?? [] as $campaign)
                    <tr class="border-b border-gray-50 hover:bg-[#f6f7f7]">
                        <td class="py-3 px-3"><strong class="text-[#2271b1]">{{ $campaign->title }}</strong></td>
                        <td class="py-3 px-3">{{ $campaign->is_active ? 'Ativa' : 'Inativa' }}</td>
                        <td class="py-3 px-3">{{ $campaign->created_at->format('d/m/Y') }}</td>
                            <td class="py-4 px-4 align-top">
                                <a href="{{ route('admin.campaigns.edit', $campaign->id) }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors mr-2">Editar</a>
                                <form action="{{ route('admin.campaigns.destroy', $campaign->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem a certeza?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition-colors">Apagar</button>
                                </form>
                            </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="py-4 px-3 text-center text-gray-500">Nenhuma campanha encontrada.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
