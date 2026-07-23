<x-admin-layout>
    <x-slot:header>Adicionar Folheto Promocional</x-slot>
    <form action="{{ route('admin.leaflets.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-6">
        @csrf
        <div class="flex-1 space-y-5">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Título do Folheto *</label>
                <input type="text" name="title" required placeholder="Ex: Catálogo Especial de Aniversário" class="w-full border-gray-300 rounded-xl text-lg px-4 py-3 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors shadow-sm" value="{{ old('title') }}">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Válido De *</label>
                    <input type="date" name="start_date" required class="w-full border-gray-300 rounded-lg text-sm px-3 py-2" value="{{ old('start_date') }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Até *</label>
                    <input type="date" name="end_date" required class="w-full border-gray-300 rounded-lg text-sm px-3 py-2" value="{{ old('end_date') }}">
                </div>
            </div>

            <div class="bg-white border border-gray-100 shadow-md rounded-xl p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Ficheiro PDF (Opcional)</label>
                    <input type="file" name="pdf_path" accept="application/pdf" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 bg-white">
                    <p class="text-xs text-gray-500 mt-1">Permite download no site. PDF máximo de 15MB.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Páginas do Folheto (Imagens) *</label>
                    <input type="file" name="images[]" multiple required accept="image/*" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 bg-white">
                    <p class="text-xs text-gray-500 mt-1">Carregue as páginas em ordem (folhear). Formatos: jpg, png, webp. Pode selecionar múltiplos ficheiros.</p>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-[280px]">
            <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden">
                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-semibold text-slate-800 text-sm">Publicar</div>
                <div class="p-6">
                    <label class="flex items-center space-x-2 text-sm text-slate-700 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded border-gray-300 text-green-600 focus:ring-green-500">
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
