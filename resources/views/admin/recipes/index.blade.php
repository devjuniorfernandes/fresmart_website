<x-admin-layout>
    <x-slot:header>Receitas</x-slot>
    <x-slot:actions>
        <a href="{{ route('admin.recipes.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2.5 px-5 rounded-xl shadow-sm transition-all duration-200 text-sm">
            <i class="fas fa-plus mr-1.5 text-xs"></i> Adicionar Nova
        </a>
    </x-slot>
    <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden max-w-7xl">
        <table class="w-full text-left text-[13px] border-collapse">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50/50">
                    <th class="py-3.5 px-6 text-xs font-bold uppercase tracking-wider text-slate-500 w-1/3">Título</th>
                    <th class="py-3.5 px-6 text-xs font-bold uppercase tracking-wider text-slate-500">Categoria</th>
                    <th class="py-3.5 px-6 text-xs font-bold uppercase tracking-wider text-slate-500">Tempo de Prep</th>
                    <th class="py-3.5 px-6 text-xs font-bold uppercase tracking-wider text-slate-500 w-1/6">Data</th>
                    <th class="py-3.5 px-6 text-xs font-bold uppercase tracking-wider text-slate-500 w-1/6 text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recipes ?? [] as $recipe)
                    <tr class="border-b border-gray-100 hover:bg-slate-50/80 transition-colors">
                        <td class="py-4 px-6 align-middle"><strong class="text-slate-800 text-sm font-bold">{{ $recipe->title }}</strong></td>
                        <td class="py-4 px-6 align-middle text-[#50575e]">{{ $recipe->category }}</td>
                        <td class="py-4 px-6 align-middle text-[#50575e]">{{ $recipe->prep_time_minutes }} min</td>
                        <td class="py-4 px-6 align-middle text-gray-500">{{ $recipe->created_at->format('d/m/Y') }}</td>
                        <td class="py-4 px-6 align-middle text-right space-x-2">
                            <a href="{{ route('admin.recipes.edit', $recipe->id) }}" class="inline-flex items-center px-3 py-1.5 bg-slate-100 hover:bg-[#45B500] hover:text-white rounded-lg text-slate-700 text-xs font-bold transition-all duration-200">
                                Editar
                            </a>
                            <form action="{{ route('admin.recipes.destroy', $recipe->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem a certeza?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 hover:bg-red-600 hover:text-white rounded-lg text-red-600 text-xs font-bold transition-all duration-200">
                                    Apagar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="py-12 px-6 text-center text-gray-400">Nenhuma receita encontrada.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
