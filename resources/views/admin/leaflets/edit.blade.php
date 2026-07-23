<x-admin-layout>
    <x-slot:header>Editar Folheto Promocional</x-slot>
    <form action="{{ route('admin.leaflets.update', $leaflet->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-6">
        @csrf
        @method('PUT')
        <div class="flex-1 space-y-5">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Título do Folheto *</label>
                <input type="text" name="title" required class="w-full border-gray-300 rounded-xl text-lg px-4 py-3 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors shadow-sm" value="{{ old('title', $leaflet->title) }}">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Válido De *</label>
                    <input type="date" name="start_date" required class="w-full border-gray-300 rounded-lg text-sm px-3 py-2" value="{{ old('start_date', $leaflet->start_date ? $leaflet->start_date->format('Y-m-d') : '') }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Até *</label>
                    <input type="date" name="end_date" required class="w-full border-gray-300 rounded-lg text-sm px-3 py-2" value="{{ old('end_date', $leaflet->end_date ? $leaflet->end_date->format('Y-m-d') : '') }}">
                </div>
            </div>

            <div class="bg-white border border-gray-100 shadow-md rounded-xl p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Ficheiro PDF (Opcional)</label>
                    @if($leaflet->pdf_path)
                        <div class="mb-2 text-xs">
                            <span class="text-gray-500">PDF Atual:</span>
                            <a href="{{ asset($leaflet->pdf_path) }}" target="_blank" class="text-red-600 font-bold hover:underline">Ver PDF Atual</a>
                        </div>
                    @endif
                    <input type="file" name="pdf_path" accept="application/pdf" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 bg-white">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Adicionar Novas Páginas (Imagens)</label>
                    <input type="file" name="images[]" multiple accept="image/*" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 bg-white">
                    <p class="text-xs text-gray-500 mt-1">Carregue páginas adicionais. Serão colocadas no final.</p>
                </div>

                @if($leaflet->images && count($leaflet->images) > 0)
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-3">Páginas Atuais (Selecione para remover)</label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-4">
                            @foreach($leaflet->images as $index => $img)
                                <div class="relative group rounded border border-gray-200 overflow-hidden">
                                    <img src="{{ asset($img) }}" class="w-full h-32 object-cover">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-all">
                                        <label class="flex items-center gap-1 text-white text-xs cursor-pointer bg-red-600 px-2 py-1 rounded">
                                            <input type="checkbox" name="remove_images[]" value="{{ $img }}" class="rounded text-red-600 focus:ring-red-500 w-3 h-3">
                                            <span>Remover</span>
                                        </label>
                                    </div>
                                    <span class="absolute top-1 left-1 bg-black/60 text-white text-[9px] font-bold px-1.5 py-0.5 rounded">
                                        Pág. {{ $index + 1 }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="w-full lg:w-[280px]">
            <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden">
                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-semibold text-slate-800 text-sm">Publicar</div>
                <div class="p-6">
                    <label class="flex items-center space-x-2 text-sm text-slate-700 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ $leaflet->is_active ? 'checked' : '' }} class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                        <span>Folheto Ativo</span>
                    </label>
                </div>
                <div class="bg-gray-50/50 border-t border-gray-100 p-4 flex justify-end">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-5 rounded-lg shadow-sm transition-all duration-200 w-full text-center">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
