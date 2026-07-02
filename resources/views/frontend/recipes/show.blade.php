<x-frontend.layout>
    <x-slot:meta_title>{{ $recipe->title }} - Receitas Fresmart</x-slot>
    <x-slot:meta_description>Descubra como preparar {{ $recipe->title }} com os melhores ingredientes da Fresmart. Tempo:
        {{ $recipe->prep_time_minutes }}m. Categoria: {{ $recipe->category }}.</x-slot>
    @if ($recipe->image)
        <x-slot:meta_image>{{ str_starts_with($recipe->image, 'uploads/') ? $recipe->image : 'storage/' . $recipe->image }}</x-slot>
    @endif
    <x-frontend.page-header :title="$recipe->title" :subtitle="$recipe->category . ' | ' . $recipe->prep_time_minutes . ' min'" :image="$recipe->image
        ? (str_starts_with($recipe->image, 'uploads/')
            ? $recipe->image
            : 'storage/' . $recipe->image)
        : 'assets/img/receita1.jpg'" />

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Left Col: Ingredients -->
        <div class="lg:col-span-1">
            <div class="bg-gray-50 rounded-2xl p-8 sticky top-24 border border-gray-100">
                <h3 class="text-2xl font-bold text-[#45B500] mb-6 flex items-center gap-3">
                    <i class="fas fa-shopping-basket"></i> Ingredientes
                </h3>
                <div class="prose prose-sm text-gray-700 whitespace-pre-line">
                    {{ $recipe->ingredients ?? 'Ingredientes não especificados.' }}
                </div>
            </div>
        </div>

        <!-- Right Col: Instructions -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <i class="fas fa-blender"></i> Modo de Preparo
                </h3>
                <div class="prose max-w-none text-gray-700 whitespace-pre-line text-lg leading-relaxed">
                    {{ $recipe->instructions ?? 'Instruções não especificadas.' }}
                </div>
            </div>
        </div>
    </div>
</x-frontend.layout>
