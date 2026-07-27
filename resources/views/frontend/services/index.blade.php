<x-frontend.layout>
    <x-frontend.page-header 
        title="{{ $settings->banner_services_title ?: 'Nossos Serviços' }}" 
        subtitle="{{ $settings->banner_services_subtitle ?: 'Conheça tudo o que a Fresmart oferece para você' }}"
        image="{{ $settings->banner_services_image ? asset($settings->banner_services_image) : asset('assets/img/hero.png') }}" />

    <section class="py-12 max-w-[1528px] mx-auto px-6 lg:px-10 min-h-[50vh]">
        <x-frontend.breadcrumbs :items="[['label' => 'Serviços']]" />
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($services as $index => $service)
                <x-frontend.card-service :service="$service" />
            @empty
                <div class="col-span-full text-center py-20 text-gray-500 text-xl">Nenhum serviço cadastrado.</div>
            @endforelse
        </div>
    </section>
</x-frontend.layout>
