<x-frontend.layout>
    <div class="bg-white border-b border-gray-100 py-6">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
            <x-frontend.breadcrumbs :items="[
                ['label' => 'Quem Somos', 'url' => route('about.index')],
                ['label' => 'Responsabilidade Social'],
            ]" />
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 uppercase mt-1">
                {{ $page->title ?? 'Responsabilidade Social' }}</h1>
            <p class="text-sm text-gray-500 mt-1">
                {{ $page->subtitle ?? 'Comprometidos com as pessoas, as comunidades e o futuro de Angola.' }}
            </p>
        </div>
    </div>

    <section class="bg-white w-full min-h-[60vh] py-8 md:py-12">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10 space-y-12">

            <div class="bg-white space-y-10">

                <!-- Section 1: O Nosso Impacto -->
                <div class="space-y-6">
                    <div class="border-b border-gray-100 pb-4">
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 uppercase">
                            {{ $page->content_title ?? 'O Nosso Impacto' }}
                        </h2>
                    </div>

                    <div class="overflow-hidden border border-gray-100 h-64 md:h-80">
                        <img src="{{ asset(str_starts_with($page->section_image_1 ?? '', 'http') ? $page->section_image_1 : ($page->section_image_1 ?: 'placeholder.png')) }}"
                            alt="Responsabilidade Social Fresmart" class="w-full h-full object-cover">
                    </div>

                    <div class="space-y-4 text-sm md:text-base text-gray-600 leading-relaxed">
                        {!! nl2br(e($page->content)) !!}
                    </div>
                </div>

                <!-- Section 2: As Nossas Áreas de Atuação -->
                <div class="space-y-6 pt-4">
                    <div class="border-b border-gray-100 pb-4">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-1">Impacto
                            Social Fresmart</span>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 uppercase">As Nossas Áreas de
                            Atuação</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Área 1 -->
                        <div class="space-y-2">
                            <h3 class="text-base font-bold text-gray-900 uppercase">Apoio a Instituições Sociais</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Colaboração com organizações e projetos que apoiam pessoas e famílias em situação de
                                vulnerabilidade.
                            </p>
                        </div>

                        <!-- Área 2 -->
                        <div class="space-y-2">
                            <h3 class="text-base font-bold text-gray-900 uppercase">Redução do Desperdício Alimentar
                            </h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Promoção de práticas que favorecem o aproveitamento responsável dos alimentos.
                            </p>
                        </div>

                        <!-- Área 3 -->
                        <div class="space-y-2">
                            <h3 class="text-base font-bold text-gray-900 uppercase">Sustentabilidade Ambiental</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Adoção de medidas para reduzir o impacto ambiental das nossas operações.
                            </p>
                        </div>

                        <!-- Área 4 -->
                        <div class="space-y-2">
                            <h3 class="text-base font-bold text-gray-900 uppercase">Desenvolvimento das Comunidades</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Apoio a iniciativas locais nas áreas da educação, saúde, cultura e inclusão social.
                            </p>
                        </div>

                        <!-- Área 5 -->
                        <div class="space-y-2">
                            <h3 class="text-base font-bold text-gray-900 uppercase">Valorização dos Colaboradores</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Investimento na formação, segurança, bem-estar e crescimento profissional das nossas
                                equipas.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Navigation link -->
                <div class="pt-6 border-t border-gray-100 flex justify-between items-center">
                    <a href="{{ route('contacts.index') }}"
                        class="bg-[#45B500] hover:bg-[#3a9900] text-white px-6 py-2.5 rounded-xl font-bold text-sm transition shadow-sm inline-block">
                        Fale com a nossa equipa
                    </a>
                </div>

            </div>
        </div>
    </section>
</x-frontend.layout>
