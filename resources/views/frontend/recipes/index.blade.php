<x-frontend.layout>
    <x-frontend.page-header 
        title="{{ $settings->banner_recipes_title ?: 'Nossas Receitas' }}" 
        subtitle="{{ $settings->banner_recipes_subtitle ?: 'Descubra pratos deliciosos para preparar em casa' }}"
        image="{{ $settings->banner_recipes_image ? asset($settings->banner_recipes_image) : asset('assets/img/receita1.jpg') }}" />

    <section class="py-20 w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[1528px] mx-auto min-h-[50vh]">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($recipes as $recipe)
                <x-frontend.card-recipe :recipe="$recipe" />
            @empty
                <div class="col-span-full flex flex-col items-center justify-center text-gray-500 py-16">
                    <i class="fas fa-utensils text-4xl mb-4 text-gray-300"></i>
                    <p class="text-xl">Nenhuma receita disponível no momento.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12 flex justify-center">
            {{ $recipes->links() }}
        </div>
    </section>
</x-frontend.layout>
