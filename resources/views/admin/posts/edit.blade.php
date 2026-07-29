<x-admin-layout>
    <x-slot:header>Editar Notícia: {{ $post->title }}</x-slot>

    <!-- Include CKEditor 5 CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-6">
        @csrf
        @method('PUT')
        <div class="flex-1 space-y-5">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Título da Notícia *</label>
                <input type="text" name="title" required class="w-full border-gray-300 rounded-xl text-lg px-4 py-3 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors shadow-sm" value="{{ old('title', $post->title) }}">
                @error('title')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Slug amigável (opcional)</label>
                <input type="text" name="slug" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors" value="{{ old('slug', $post->slug) }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Resumo / Excerto (opcional)</label>
                <textarea name="excerpt" rows="2" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors">{{ old('excerpt', $post->excerpt) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Conteúdo da Notícia (Editor CKEditor) *</label>
                <textarea name="content" id="editor" rows="12" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>
            
            <!-- IMAGENS DA NOTÍCIA -->
            <div class="bg-white border border-gray-100 shadow-md rounded-xl p-6 space-y-6">
                <!-- Imagem Principal de Capa -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5 uppercase">Imagem Principal de Capa</label>
                    @if($post->image)
                        <div class="mb-3 rounded-xl overflow-hidden border border-gray-200 h-40 w-full md:w-80 bg-gray-50 shadow-sm">
                            <img src="{{ asset(str_starts_with($post->image, 'uploads/') ? $post->image : 'storage/'.$post->image) }}" class="w-full h-full object-cover">
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-[#45B500] hover:file:bg-green-100 cursor-pointer">
                    <p class="text-xs text-gray-500 mt-1">Deixe em branco para manter a imagem de capa atual.</p>
                </div>

                <hr class="border-gray-100">

                <!-- Galeria de Imagens Lightbox -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5 uppercase flex items-center gap-2">
                        <i class="fas fa-[#45B500] fa-images"></i> Galeria de Imagens da Notícia (Lightbox)
                    </label>

                    @if(is_array($post->gallery) && count($post->gallery) > 0)
                        <p class="text-xs font-semibold text-gray-600 mb-3">Imagens Atuais da Galeria (Selecione para eliminar):</p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-4">
                            @foreach($post->gallery as $gIndex => $gPath)
                                <div class="relative group rounded-xl overflow-hidden border border-gray-200 shadow-sm bg-gray-50">
                                    <img src="{{ asset($gPath) }}" class="w-full h-28 object-cover">
                                    <label class="absolute bottom-1 right-1 bg-red-600 hover:bg-red-700 text-white p-1.5 rounded-lg text-xs cursor-pointer flex items-center gap-1 shadow">
                                        <input type="checkbox" name="remove_gallery_images[]" value="{{ $gPath }}" class="rounded text-red-600 focus:ring-red-500 w-3.5 h-3.5">
                                        <span class="text-[10px] font-bold">Apagar</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Adicionar Mais Imagens à Galeria:</label>
                    <input type="file" name="gallery[]" multiple accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-[#45B500] hover:file:bg-green-100 cursor-pointer">
                    <p class="text-xs text-gray-500 mt-1">Selecione uma ou mais fotos para adicionar à galeria Lightbox desta notícia.</p>
                </div>
            </div>
        </div>
        
        <div class="w-full lg:w-[280px] space-y-6">
            <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden sticky top-24">
                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-semibold text-slate-800 text-sm">Publicação</div>
                <div class="p-6 space-y-4">
                    <label class="flex items-center space-x-2 text-sm text-slate-700 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ $post->is_active ? 'checked' : '' }} class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                        <span>Notícia Ativa</span>
                    </label>

                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1.5">Data de Publicação</label>
                        <input type="datetime-local" name="published_at" class="w-full border-gray-300 rounded-lg text-xs px-3 py-2 focus:border-green-500" value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}">
                    </div>
                </div>
                <div class="bg-gray-50/50 border-t border-gray-100 p-4 flex justify-end">
                    <button type="submit" class="bg-[#45B500] hover:bg-[#3a9900] text-white font-bold py-3 px-5 rounded-xl shadow-sm transition-all duration-200 w-full text-center uppercase tracking-wider text-xs cursor-pointer">Guardar Notícia</button>
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
