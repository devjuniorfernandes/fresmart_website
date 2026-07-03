<x-admin-layout>
    <x-slot:header>Serviços</x-slot>
    <x-slot:actions>
        <a href="{{ route('admin.services.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2.5 px-5 rounded-xl shadow-sm transition-all duration-200 text-sm">
            <i class="fas fa-plus mr-1.5 text-xs"></i> Adicionar Novo
        </a>
    </x-slot>
    <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden max-w-7xl">
        <table class="w-full text-left text-[13px] border-collapse">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50/50">
                    <th class="py-3.5 px-6 text-xs font-bold uppercase tracking-wider text-slate-500">Nome</th>
                    <th class="py-3.5 px-6 text-xs font-bold uppercase tracking-wider text-slate-500">Data</th>
                    <th class="py-3.5 px-6 text-xs font-bold uppercase tracking-wider text-slate-500 w-1/6 text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services ?? [] as $service)
                    <tr class="border-b border-gray-100 hover:bg-slate-50/80 transition-colors">
                        <td class="py-4 px-6 align-middle"><strong class="text-slate-800 text-sm font-bold">{{ $service->name }}</strong></td>
                        <td class="py-4 px-6 align-middle text-gray-500">{{ $service->created_at->format('d/m/Y') }}</td>
                        <td class="py-4 px-6 align-middle text-right space-x-2">
                            <a href="{{ route('admin.services.edit', $service->id) }}" class="inline-flex items-center px-3 py-1.5 bg-slate-100 hover:bg-[#45B500] hover:text-white rounded-lg text-slate-700 text-xs font-bold transition-all duration-200">
                                Editar
                            </a>
                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem a certeza?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 hover:bg-red-600 hover:text-white rounded-lg text-red-600 text-xs font-bold transition-all duration-200">
                                    Apagar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="py-12 px-6 text-center text-gray-400">Nenhum serviço cadastrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
