<x-admin-layout>
    <x-slot:header>Adicionar Campanha</x-slot>
    <form action="{{ route('admin.campaigns.update', $campaign->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-6">
        @csrf
        @method('PUT')
        <div class="flex-1 space-y-4">
            <input type="text" name="title" required placeholder="Título da Campanha" class="w-full border-gray-300 rounded-xl text-lg px-4 py-3 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors shadow-sm" value="{{ old('title', $campaign->title) }}">
            <input type="text" name="slug" placeholder="Slug (opcional - gerado automaticamente)" class="w-full border-gray-300 rounded-xl text-lg px-4 py-3 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors shadow-sm mt-2" value="{{ old('slug', $campaign->slug) }}">
            <div class="bg-white border border-gray-100 shadow-md rounded-xl p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Imagem da Campanha</label>
                    <input type="file" name="image" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors bg-white" >
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Link de Redirecionamento</label>
                    <input type="text" name="link" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors" placeholder="https://..." value="{{ old('link', $campaign->link) }}">
                </div>
            </div>
        </div>
        <div class="w-full lg:w-[280px]">
            <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden">
                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-semibold text-slate-800 text-sm">Publicar</div>
                <div class="p-3">
                    <select name="is_active" class="w-full border-[#8c8f94] rounded-[3px] text-[13px]" value="{{ old('is_active', $campaign->is_active) }}">
                        <option value="1">Ativa</option>
                        <option value="0">Inativa</option>
                    </select>
                </div>
                <div class="p-4 border-t border-gray-100">
                    <label class="flex items-center space-x-2 text-sm text-slate-700 cursor-pointer">
                        <input type="checkbox" name="show_text" value="1" {{ $campaign->show_text ? 'checked' : '' }} class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                        <span>Mostrar Texto por Cima</span>
                    </label>
                </div>
                <div class="bg-gray-50/50 p-4 flex justify-end">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-5 rounded-lg shadow-sm transition-all duration-200">Publicar</button>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
