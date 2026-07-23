<x-frontend.layout>
    <x-slot:meta_title>{{ $recipe->title }} - Receitas Fresmart</x-slot>
    <x-slot:meta_description>Descubra como preparar {{ $recipe->title }} com os melhores ingredientes da Fresmart. Tempo: {{ $recipe->prep_time_minutes }}m. Categoria: {{ $recipe->category }}.</x-slot>
    @if ($recipe->image)
        <x-slot:meta_image>{{ str_starts_with($recipe->image, 'uploads/') ? $recipe->image : 'storage/' . $recipe->image }}</x-slot>
    @endif
    <x-frontend.page-header :title="$recipe->title" :subtitle="$recipe->category" :image="$recipe->image
        ? (str_starts_with($recipe->image, 'uploads/')
            ? $recipe->image
            : 'storage/' . $recipe->image)
        : 'assets/img/receita1.jpg'" />

    <section class="py-16 md:py-24 bg-white w-full">
        <div class="w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[1528px] mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Left Column (Images, Meta) -->
                <div class="lg:col-span-5 space-y-8">
                    <!-- Main Recipe Cover Image -->
                    <div class="w-full aspect-[4/3] rounded-3xl overflow-hidden shadow-md border border-gray-100 relative bg-gray-50">
                        <img src="{{ $recipe->image ? asset(str_starts_with($recipe->image, 'uploads/') ? $recipe->image : 'storage/'.$recipe->image) : asset('assets/img/receita1.jpg') }}" 
                             alt="{{ $recipe->title }}" class="w-full h-full object-cover">
                    </div>

                    <!-- Meta Details Info Card -->
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 flex justify-around text-center">
                        <div>
                            <span class="block text-[10px] font-bold text-gray-400 uppercase">Tempo de Preparo</span>
                            <span class="block font-extrabold text-gray-800 text-sm mt-1">
                                <i class="far fa-clock text-[#45B500] mr-1"></i> {{ $recipe->prep_time_minutes }} min
                            </span>
                        </div>
                        <div class="border-r border-gray-200"></div>
                        <div>
                            <span class="block text-[10px] font-bold text-gray-400 uppercase">Rendimento</span>
                            <span class="block font-extrabold text-gray-800 text-sm mt-1">
                                <i class="fas fa-utensils text-[#45B500] mr-1"></i> {{ $recipe->portions ?? 4 }} porções
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Right Column (Ingredients & Instructions / Preparation Mode) -->
                <div class="lg:col-span-7 space-y-8">
                    <!-- Ingredients Card -->
                    <div class="bg-gray-50/50 rounded-3xl p-8 border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-5 flex items-center gap-3">
                            <i class="fas fa-shopping-basket text-[#45B500]"></i> Ingredientes
                        </h3>
                        <div class="prose prose-sm text-gray-700 whitespace-pre-line leading-relaxed text-sm">
                            {!! $recipe->ingredients ?? 'Ingredientes não especificados.' !!}
                        </div>
                    </div>

                    <!-- Modo de Preparo Card -->
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <i class="fas fa-blender text-[#45B500]"></i> Modo de Preparação
                        </h3>
                        <div class="prose max-w-none text-gray-700 whitespace-pre-line text-sm md:text-base leading-relaxed">
                            {!! $recipe->instructions ?? 'Instruções não especificadas.' !!}
                        </div>
                    </div>

                    <div class="pt-4">
                        <a href="{{ route('recipes.index') }}" class="text-[#45B500] font-bold hover:underline text-sm inline-flex items-center gap-2">
                            &larr; Voltar para todas as receitas
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-frontend.layout>
