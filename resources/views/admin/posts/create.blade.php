<x-admin-layout>
    <x-slot:header>Adicionar Notícia</x-slot>
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-6">
        @csrf
        <div class="flex-1 space-y-5">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Título da Notícia *</label>
                <input type="text" name="title" required placeholder="Título oficial" class="w-full border-gray-300 rounded-xl text-lg px-4 py-3 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors shadow-sm" value="{{ old('title') }}">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Slug amigável (opcional)</label>
                <input type="text" name="slug" placeholder="ex: titulo-da-noticia" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors" value="{{ old('slug') }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Resumo / Excerto (opcional)</label>
                <textarea name="excerpt" rows="2" placeholder="Um pequeno resumo de introdução..." class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors">{{ old('excerpt') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Conteúdo da Notícia *</label>
                <textarea name="content" rows="10" required placeholder="Escreva o artigo completo aqui..." class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors">{{ old('content') }}</textarea>
            </div>
            
            <div class="bg-white border border-gray-100 shadow-md rounded-xl p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Imagem de Capa</label>
                    <input type="file" name="image" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors bg-white">
                    <p class="text-xs text-gray-500 mt-1">Formatos: jpg, png, webp. Tamanho máximo: 5MB.</p>
                </div>
            </div>
        </div>
        
        <div class="w-full lg:w-[280px] space-y-6">
            <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden">
                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-semibold text-slate-800 text-sm">Publicação</div>
                <div class="p-6 space-y-4">
                    <label class="flex items-center space-x-2 text-sm text-slate-700 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                        <span>Notícia Ativa</span>
                    </label>

                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1.5">Data de Publicação</label>
                        <input type="datetime-local" name="published_at" class="w-full border-gray-300 rounded-lg text-xs px-3 py-2 focus:border-green-500" value="{{ old('published_at') }}">
                    </div>
                </div>
                <div class="bg-gray-50/50 border-t border-gray-100 p-4 flex justify-end">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-5 rounded-lg shadow-sm transition-all duration-200 w-full text-center">Publicar</button>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
