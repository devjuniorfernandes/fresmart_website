<x-frontend.layout>
    <!-- Header & Breadcrumbs -->
    <div class="bg-white border-b border-gray-100 py-6">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
            <x-frontend.breadcrumbs :items="[['label' => 'Quem Somos', 'url' => route('about.index')], ['label' => 'Trabalhe Connosco']]" />
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 uppercase mt-1">
                {{ $page->title ?? 'Trabalhe Connosco' }}
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                {{ $page->subtitle ?? 'Faça parte da equipa que faz a diferença todos os dias nas nossas lojas e serviços em Angola.' }}
            </p>
        </div>
    </div>

    <section class="bg-white w-full min-h-[60vh] py-8 md:py-12">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10 space-y-12">

            <div class="bg-white space-y-12">

                <!-- Section 1: Hero Split (Texto + Colagem de Imagens) -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-7 space-y-6">
                        <div
                            class="inline-block px-3 py-1 bg-green-50 text-[#45B500] font-bold text-xs uppercase tracking-wider rounded-full">
                            Carreiras na Fresmart
                        </div>
                        <h2 class="text-3xl md:text-4xl font-black text-gray-900 uppercase leading-tight">
                            {{ $page->content_title ?? 'Construa o seu Futuro connosco' }}
                        </h2>
                        <div class="space-y-4 text-sm md:text-base text-gray-600 leading-relaxed">
                            @if(!empty($page->content))
                                {!! nl2br(e($page->content)) !!}
                            @else
                                <p>
                                    Na <strong>Fresmart</strong>, acreditamos que o nosso sucesso é construído pelas pessoas
                                    que fazem parte da nossa equipa. Procuramos profissionais comprometidos, dinâmicos e
                                    apaixonados pelo atendimento ao cliente, que queiram crescer connosco e contribuir para
                                    proporcionar uma experiência de compra de excelência.
                                </p>
                                <p>
                                    Independentemente da função que desempenha — nas nossas lojas, centrais de frescura ou
                                    operações —, cada colaborador desempenha um papel fundamental na construção da confiança
                                    que os nossos clientes depositam diariamente em nós.
                                </p>
                            @endif
                        </div>

                        <div class="pt-2">
                            <a href="{{ route('candidatura.form') }}" class="inline-flex items-center gap-2 bg-[#45B500] hover:bg-[#3a9900] text-white font-bold px-6 py-3.5 shadow-md transition-all duration-300 text-sm uppercase tracking-wider">
                                <span>Preencher Formulário de Candidatura</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>

                        <!-- Stats Quick Highlights -->
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 pt-4 border-t border-gray-100">
                            <div>
                                <span class="text-2xl md:text-3xl font-black text-[#45B500]">+650</span>
                                <p class="text-xs font-bold uppercase text-gray-500">Colaboradores</p>
                            </div>
                            <div>
                                <span class="text-2xl md:text-3xl font-black text-[#45B500]">+18</span>
                                <p class="text-xs font-bold uppercase text-gray-500">Lojas em Angola</p>
                            </div>
                            <div>
                                <span class="text-2xl md:text-3xl font-black text-[#45B500]">100%</span>
                                <p class="text-xs font-bold uppercase text-gray-500">Foco nas Pessoas</p>
                            </div>
                        </div>
                    </div>

                    <!-- Image Collage (Right Column) -->
                    <div class="lg:col-span-5 grid grid-cols-2 gap-4">
                        <div class="overflow-hidden border border-gray-100">
                            <img src="{{ asset(str_starts_with($page->section_image_1 ?? '', 'http') ? $page->section_image_1 : ($page->section_image_1 ?: 'placeholder.png')) }}"
                                alt="Equipa Fresmart"
                                class="w-full h-56 md:h-64 object-cover">
                        </div>
                        <div class="overflow-hidden mt-6 border border-gray-100">
                            <img src="{{ asset(str_starts_with($page->section_image_2 ?? '', 'http') ? $page->section_image_2 : ($page->section_image_2 ?: 'placeholder.png')) }}"
                                alt="Atendimento Fresmart"
                                class="w-full h-56 md:h-64 object-cover">
                        </div>
                        <div class="col-span-2 overflow-hidden border border-gray-100">
                            <img src="{{ asset(str_starts_with($page->section_image_3 ?? '', 'http') ? $page->section_image_3 : ($page->section_image_3 ?: 'placeholder.png')) }}"
                                alt="Ambiente de Trabalho Fresmart"
                                class="w-full h-48 object-cover">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Porque trabalhar na Fresmart? -->
                <div class="space-y-6 pt-8 border-t border-gray-100">
                    <div class="max-w-3xl space-y-2">
                        <h3 class="text-2xl md:text-3xl font-extrabold text-gray-900 uppercase">Porque trabalhar na Fresmart?</h3>
                        <div class="text-sm md:text-base text-gray-600 leading-relaxed space-y-3">
                            @if(!empty($page->extra_content_1))
                                {!! nl2br(e($page->extra_content_1)) !!}
                            @else
                                <p>
                                    Na Fresmart encontrará mais do que um emprego. Encontrará oportunidades para aprender,
                                    evoluir e construir uma carreira sólida numa empresa que acredita nas pessoas como o seu
                                    maior ativo. Valorizamos o empenho, reconhecemos o mérito e incentivamos o crescimento
                                    profissional através da formação contínua e da promoção interna.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Section 4: Visual Gallery - As Nossas Áreas de Oportunidade -->
                <div class="space-y-6 pt-4 border-t border-gray-100">
                    <div class="border-b border-gray-100 pb-4">
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 uppercase">Áreas de Oportunidade</h2>
                        <p class="text-sm text-gray-500 mt-1">Conheça as diversas áreas onde pode desenvolver o seu talento connosco.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Card 1: Lojas & Atendimento -->
                        <div class="group overflow-hidden border border-gray-100 bg-white">
                            <div class="h-44 overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=600&q=80"
                                    alt="Operações de Loja"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-4 space-y-1">
                                <h4 class="font-bold text-gray-900 text-sm uppercase">Operações de Loja</h4>
                                <p class="text-xs text-gray-500">Caixas, reposição, atendimento ao cliente e gestão de balcão.</p>
                            </div>
                        </div>

                        <!-- Card 2: Frescos & Talho -->
                        <div class="group overflow-hidden border border-gray-100 bg-white">
                            <div class="h-44 overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1588964895597-cfccd6e2dbf9?auto=format&fit=crop&w=600&q=80"
                                    alt="Frescos e Talho"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-4 space-y-1">
                                <h4 class="font-bold text-gray-900 text-sm uppercase">Especialistas de Frescos</h4>
                                <p class="text-xs text-gray-500">Técnicos de talho, charcutaria, padaria e fruta de qualidade.</p>
                            </div>
                        </div>

                        <!-- Card 3: Logística & Armazém -->
                        <div class="group overflow-hidden border border-gray-100 bg-white">
                            <div class="h-44 overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=600&q=80"
                                    alt="Logística e Armazém"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-4 space-y-1">
                                <h4 class="font-bold text-gray-900 text-sm uppercase">Logística & Armazém</h4>
                                <p class="text-xs text-gray-500">Recepção, cadeia de frio, conferência e distribuição nacional.</p>
                            </div>
                        </div>

                        <!-- Card 4: Gestão & Serviços Centrais -->
                        <div class="group overflow-hidden border border-gray-100 bg-white">
                            <div class="h-44 overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=600&q=80"
                                    alt="Serviços Centrais"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-4 space-y-1">
                                <h4 class="font-bold text-gray-900 text-sm uppercase">Serviços Centrais</h4>
                                <p class="text-xs text-gray-500">Gestão, compras, recursos humanos, marketing e financeiro.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 6: CTA Link para a Página do Formulário de Candidatura -->
                <div class="pt-8 border-t border-gray-100">
                    <div class="bg-gray-50/70 p-8 md:p-12 border border-gray-100 flex flex-col md:flex-row items-center justify-between gap-6">
                        <div class="space-y-2 max-w-2xl">
                            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 uppercase">
                                Envie a sua Candidatura
                            </h2>
                            <div class="text-sm text-gray-600 leading-relaxed">
                                @if(!empty($page->extra_content_2))
                                    {!! nl2br(e($page->extra_content_2)) !!}
                                @else
                                    <p>Acredita que pode fazer a diferença na Fresmart? Aceda ao nosso formulário de candidatura dedicado, selecione a sua área de interesse e envie o seu CV.</p>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('candidatura.form') }}"
                            class="bg-[#45B500] hover:bg-[#3a9900] text-white font-bold py-4 px-8 transition-all duration-300 shadow-md flex items-center gap-3 text-sm uppercase tracking-wider flex-shrink-0">
                            <span>Ir para o Formulário</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-frontend.layout>
