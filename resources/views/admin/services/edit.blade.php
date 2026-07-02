<x-admin-layout>
    <x-slot:header>Editar Serviço: {{ $service->name }}</x-slot>
    <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-6">
        @csrf
        @method('PUT')
        <div class="flex-1 space-y-4">
            <input type="text" name="name" required placeholder="Nome do Serviço (ex: Frescafé)" class="w-full border-gray-300 rounded-xl text-lg px-4 py-3 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors shadow-sm" value="{{ old('name', $service->name) }}">
            <input type="text" name="slug" placeholder="Slug (opcional - gerado automaticamente)" class="w-full border-gray-300 rounded-xl text-lg px-4 py-3 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors shadow-sm mt-2" value="{{ old('slug', $service->slug) }}">
            <div class="bg-white border border-gray-100 shadow-md rounded-xl p-6">
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Descrição</label>
                <textarea name="description" rows="4" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors">{{ old('description', $service->description) }}</textarea>
            </div>
        </div>
        <div class="w-full lg:w-[280px] space-y-6">
            <!-- Box: Opções -->
            <div class="bg-white border border-gray-100 shadow-md rounded-xl p-6">
                <div class="font-semibold text-slate-800 text-sm mb-4 border-b border-gray-50 pb-2">Opções de Exibição</div>
                <label class="inline-flex items-center cursor-pointer select-none">
                    <input type="checkbox" name="show_title" value="1" {{ $service->show_title ? 'checked' : '' }} class="rounded text-[#45B500] focus:ring-[#45B500] border-gray-300 mr-2">
                    <span class="text-sm font-medium text-slate-700">Mostrar Título no Site</span>
                </label>
            </div>

            <!-- Box: Imagem de Capa -->
            <div class="bg-white border border-gray-100 shadow-md rounded-xl p-6">
                <div class="font-semibold text-slate-800 text-sm mb-4 border-b border-gray-50 pb-2">Imagem de Capa</div>
                @if($service->image)
                    <div class="mb-3 rounded-lg overflow-hidden border border-gray-100 h-32 relative bg-gray-50">
                        <img src="{{ asset(str_starts_with($service->image, 'uploads/') ? $service->image : 'storage/' . $service->image) }}" class="w-full h-full object-cover" alt="Imagem atual">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-[#45B500] hover:file:bg-green-100 cursor-pointer">
            </div>

            <!-- Box: Publicar -->
            <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden">
                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-semibold text-slate-800 text-sm">Publicar</div>
                <div class="bg-gray-50/50 p-4 flex justify-end">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-5 rounded-lg shadow-sm transition-all duration-200 w-full text-center">Salvar Alterações</button>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
