<x-admin-layout>
    <x-slot:header>Produtos (Categorias)</x-slot>
    <x-slot:actions>
        <a href="{{ route('admin.products.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg shadow-sm transition-all duration-200 text-sm">Adicionar Novo</a>
    </x-slot>
    <div class="bg-white border border-gray-50 shadow-md rounded-xl overflow-hidden">
        <table class="w-full text-left text-[13px]">
            <thead>
                <tr class="border-b border-gray-50 bg-gray-50/50">
                    <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Nome</th>
                    <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Data</th>
                    <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/6">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products ?? [] as $product)
                    <tr class="border-b border-gray-50 hover:bg-[#f6f7f7]">
                        <td class="py-3 px-3"><strong class="text-[#2271b1]">{{ $product->name }}</strong></td>
                        <td class="py-3 px-3">{{ $product->created_at->format('d/m/Y') }}</td>
                        <td class="py-4 px-4 align-top">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors mr-2">Editar</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem a certeza?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition-colors">Apagar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="py-4 px-3 text-center text-gray-500">Nenhum produto cadastrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
