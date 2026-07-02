<x-admin-layout>
    <x-slot:header>Editar Slide</x-slot>
    <form action="{{ route('admin.slides.update', $slide->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-6">
        @csrf
        @method('PUT')
        <div class="flex-1 space-y-5">
            <input type="text" name="title" placeholder="Título (texto branco)" class="w-full border-gray-300 rounded-xl text-lg px-4 py-3 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors shadow-sm" value="{{ old('title', $slide->title) }}">
            <input type="text" name="subtitle" placeholder="Subtítulo (texto verde)" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors" value="{{ old('subtitle', $slide->subtitle) }}">
            
            <div class="bg-white border border-gray-100 shadow-md rounded-xl p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Imagem de Fundo *</label>
                    <input type="file" name="image"  class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors bg-white">
                    <p class="text-xs text-gray-500 mt-1">Tamanho recomendado: 1920x600px. Formatos: jpg, png, webp.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Link do Botão "Saiba Mais" (opcional)</label>
                    <input type="text" name="link" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors" placeholder="https://..." value="{{ old('link', $slide->link) }}">
                </div>
            </div>
        </div>
        <div class="w-full lg:w-[280px]">
            <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden">
                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-semibold text-slate-800 text-sm">Publicar</div>
                <div class="p-6">
                    <label class="flex items-center space-x-2 text-sm text-slate-700 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ $slide->is_active ? 'checked' : '' }} class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                        <span>Slide Ativo</span>
                    </label>
                </div>
                <div class="bg-gray-50/50 border-t border-gray-100 p-4 flex justify-end">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-5 rounded-lg shadow-sm transition-all duration-200">Publicar</button>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>