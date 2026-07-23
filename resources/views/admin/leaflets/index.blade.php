<x-admin-layout>
    <x-slot:header>Folhetos Promocionais</x-slot>
    <x-slot:actions>
        <a href="{{ route('admin.leaflets.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg shadow-sm transition-all duration-200 text-sm">Novo Folheto</a>
    </x-slot>

    <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-[13px]">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/50">
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/4">Capa / Páginas</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Título / Validade</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/6">PDF</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/6">Estado</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/6">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leaflets as $leaflet)
                        <tr class="border-b border-gray-50 hover:bg-gray-50 group transition-colors duration-150">
                            <td class="py-4 px-4 align-top">
                                @if($leaflet->images && count($leaflet->images) > 0)
                                    <div class="flex items-center gap-2">
                                        <img src="{{ asset($leaflet->images[0]) }}" class="h-16 w-12 object-cover rounded border border-gray-200 shadow-sm">
                                        <span class="text-xs text-gray-500 font-semibold bg-gray-100 px-2 py-1 rounded">
                                            {{ count($leaflet->images) }} pág.
                                        </span>
                                    </div>
                                @else
                                    <div class="h-16 w-12 rounded border border-gray-200 bg-gray-50 flex items-center justify-center text-gray-400">
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="py-4 px-4 align-top">
                                <strong class="text-slate-800 text-sm block mb-1">{{ $leaflet->title }}</strong>
                                <span class="text-xs text-gray-500 block">
                                    <i class="far fa-calendar-alt text-[#45B500] mr-1"></i>
                                    {{ $leaflet->start_date ? $leaflet->start_date->format('d/m/Y') : '' }} - {{ $leaflet->end_date ? $leaflet->end_date->format('d/m/Y') : '' }}
                                </span>
                            </td>
                            <td class="py-4 px-4 align-top text-gray-600 text-xs">
                                @if($leaflet->pdf_path)
                                    <a href="{{ asset($leaflet->pdf_path) }}" target="_blank" class="text-red-600 hover:underline flex items-center gap-1.5">
                                        <i class="far fa-file-pdf text-base"></i> Ver PDF
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="py-4 px-4 align-top">
                                @if($leaflet->is_active)
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-md text-xs font-semibold">Ativo</span>
                                @else
                                    <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-md text-xs font-semibold">Inativo</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 align-top">
                                <a href="{{ route('admin.leaflets.edit', $leaflet->id) }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors mr-2">Editar</a>
                                <form action="{{ route('admin.leaflets.destroy', $leaflet->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem a certeza?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition-colors">Apagar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-6 px-4 text-center text-gray-500">Nenhum folheto promocional encontrado.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
