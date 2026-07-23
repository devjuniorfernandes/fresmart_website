<x-admin-layout>
    <x-slot:header>Editar Receita</x-slot>
    <form action="{{ route('admin.recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-6">
        @csrf
        @method('PUT')
        <div class="flex-1 space-y-4">
            <input type="text" name="title" required placeholder="Título da Receita" class="w-full border-gray-300 rounded-xl text-lg px-4 py-3 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors shadow-sm" value="{{ old('title', $recipe->title) }}">
            <input type="text" name="slug" placeholder="Slug (opcional - gerado automaticamente)" class="w-full border-gray-300 rounded-xl text-lg px-4 py-3 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors shadow-sm mt-2" value="{{ old('slug', $recipe->slug) }}">
            <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden">
                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-semibold text-slate-800 text-sm">Detalhes da Receita</div>
                <div class="p-6 space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Imagem da Receita</label>
                        <input type="file" name="image" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors bg-white" >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Categoria</label>
                        <input type="text" name="category" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors" required value="{{ old('category', $recipe->category) }}">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Tempo de Preparo (minutos)</label>
                            <input type="number" name="prep_time_minutes" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors" value="{{ old('prep_time_minutes', $recipe->prep_time_minutes) }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Porções</label>
                            <input type="number" name="portions" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors" value="{{ old('portions', $recipe->portions ?? 4) }}">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Ingredientes</label>
                        <textarea name="ingredients" rows="3" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors">{{ old('ingredients', $recipe->ingredients) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Modo de Preparo</label>
                        <textarea name="instructions" rows="4" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors">{{ old('instructions', $recipe->instructions) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full lg:w-[280px] space-y-4">
            @if($recipe->image)
                <div class="bg-white border border-gray-100 shadow-md rounded-xl p-4">
                    <span class="block text-xs font-bold text-gray-400 uppercase mb-2">Imagem Atual</span>
                    <img src="{{ asset(str_starts_with($recipe->image, 'uploads/') ? $recipe->image : 'storage/' . $recipe->image) }}" class="w-full h-auto rounded-lg border border-gray-100 max-h-[140px] object-cover" />
                </div>
            @endif
            <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden">
                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-semibold text-slate-800 text-sm">Publicar</div>
                <div class="p-4 space-y-3">
                    <label class="flex items-center space-x-2 text-sm text-slate-700 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" {{ $recipe->is_featured ? 'checked' : '' }} class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                        <span>Receita em Destaque</span>
                    </label>
                </div>
                <div class="bg-gray-50/50 border-t border-gray-100 p-4 flex justify-end">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-5 rounded-lg shadow-sm transition-all duration-200 w-full text-center">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
