<x-frontend.layout>
    <x-frontend.page-header 
        title="{{ $settings->banner_services_title ?: 'Nossos Serviços' }}" 
        subtitle="{{ $settings->banner_services_subtitle ?: 'Conheça tudo o que a Fresmart oferece para você' }}"
        image="{{ $settings->banner_services_image ? asset($settings->banner_services_image) : asset('assets/img/hero.png') }}" />

    <section class="py-20 w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[1528px] mx-auto min-h-[50vh]">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($services as $index => $service)
                <x-frontend.card-service :service="$service" />
            @empty
                <div class="col-span-full text-center py-20 text-gray-500 text-xl">Nenhum serviço cadastrado.</div>
            @endforelse
        </div>
    </section>
</x-frontend.layout>
