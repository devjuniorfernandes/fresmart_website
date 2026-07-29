<x-admin-layout>
    <x-slot:header>Adicionar Notícia</x-slot>

    <!-- Include CKEditor 5 CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-6">
        @csrf
        <div class="flex-1 space-y-5">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Título da Notícia *</label>
                <input type="text" name="title" required placeholder="Título oficial da notícia" class="w-full border-gray-300 rounded-xl text-lg px-4 py-3 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors shadow-sm" value="{{ old('title') }}">
                @error('title')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
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
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Conteúdo da Notícia (Editor CKEditor) *</label>
                <textarea name="content" id="editor" rows="12" placeholder="Escreva o artigo completo aqui..." class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors">{{ old('content') }}</textarea>
                @error('content')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="bg-white border border-gray-100 shadow-md rounded-xl p-6 space-y-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5 uppercase">Imagem Principal de Capa</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-[#45B500] hover:file:bg-green-100 cursor-pointer">
                    <p class="text-xs text-gray-500 mt-1">Formatos suportados: JPG, PNG, WEBP, SVG. Máximo 10MB.</p>
                </div>

                <hr class="border-gray-100">

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5 uppercase flex items-center gap-2">
                        <i class="fas fa-[#45B500] fa-images"></i> Galeria de Imagens da Notícia (Lightbox)
                    </label>
                    <input type="file" name="gallery[]" multiple accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-[#45B500] hover:file:bg-green-100 cursor-pointer">
                    <p class="text-xs text-gray-500 mt-1">Selecione uma ou mais imagens para criar uma galeria interativa Lightbox no artigo.</p>
                </div>
            </div>
        </div>
        
        <div class="w-full lg:w-[280px] space-y-6">
            <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden sticky top-24">
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
                    <button type="submit" class="bg-[#45B500] hover:bg-[#3a9900] text-white font-bold py-3 px-5 rounded-xl shadow-sm transition-all duration-200 w-full text-center uppercase tracking-wider text-xs cursor-pointer">Publicar Notícia</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo' ]
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
</x-admin-layout>
