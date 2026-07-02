<x-frontend.layout>
    <x-frontend.page-header title="Ofertas Especiais" subtitle="Os melhores preços e campanhas para você" image="assets/img/Ofertas Imperdíveis.jpg" />

    <section class="py-20 w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[1528px] mx-auto min-h-[50vh]">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($campaigns as $campaign)
                <x-frontend.card-campaign :campaign="$campaign" />
            @empty
                <div class="col-span-full text-center py-20 text-gray-500 text-xl">Nenhuma oferta disponível no momento.</div>
            @endforelse
        </div>
        
        <div class="mt-12 flex justify-center">
            {{ $campaigns->links() }}
        </div>
    </section>
</x-frontend.layout>
