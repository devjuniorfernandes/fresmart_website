<x-frontend.layout>
    <div class="bg-white border-b border-gray-100 py-6">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
            <x-frontend.breadcrumbs :items="[['label' => 'Quem Somos', 'url' => route('about.index')], ['label' => 'Sustentabilidade']]" />
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 uppercase mt-1">Sustentabilidade</h1>
            <p class="text-sm text-gray-500 mt-1">Crescer de forma responsável, hoje e no futuro.</p>
        </div>
    </div>

    <section class="py-12 md:py-16 bg-gray-50/50 w-full min-h-[60vh]">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10 space-y-12">

            <!-- Main Content Container -->
            <div class="bg-white border border-gray-100 shadow-sm p-8 md:p-12 space-y-10">

                <!-- Section 1: O Nosso Compromisso -->
                <div class="space-y-6">
                    <div class="border-b border-gray-100 pb-4">
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 uppercase">O Nosso Compromisso</h2>
                    </div>

                    <div class="overflow-hidden border border-gray-100">
                        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=1400&q=80"
                            alt="Sustentabilidade Frasmart" class="w-full h-64 md:h-80 object-cover">
                    </div>

                    <div class="space-y-4 text-sm md:text-base text-gray-600 leading-relaxed">
                        <p>
                            Na <strong>Frasmart</strong>, acreditamos que o sucesso de uma empresa mede-se não apenas
                            pelos resultados que alcança, mas também pelo impacto positivo que gera na vida das pessoas,
                            nas comunidades onde está presente e no ambiente que todos partilhamos. A sustentabilidade
                            faz parte da forma como pensamos, decidimos e trabalhamos todos os dias.
                        </p>
                        <p>
                            O nosso compromisso passa por promover um crescimento responsável, baseado em práticas que
                            valorizam a utilização consciente dos recursos, o apoio aos produtores locais, a redução do
                            desperdício alimentar e o desenvolvimento das comunidades. Cada pequena ação representa um
                            passo importante para construir um futuro mais sustentável.
                        </p>
                        <p>
                            Sabemos que os desafios ambientais e sociais exigem uma resposta coletiva. Por isso,
                            trabalhamos continuamente para melhorar os nossos processos, fortalecer relações de
                            confiança com fornecedores e clientes e contribuir para um comércio mais responsável,
                            transparente e sustentável.
                        </p>
                    </div>
                </div>

                <!-- Section 2: Compromisso Ecológico & Os Nossos Pilares de Sustentabilidade -->
                <div class="space-y-6 pt-4">
                    <div class="border-b border-gray-100 pb-4">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-1">Compromisso
                            Ecológico Fresmart</span>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 uppercase">Os Nossos Pilares de
                            Sustentabilidade</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Pilar 1 -->
                        <div class="bg-gray-50/80 border border-gray-100 p-6 space-y-3">
                            <h3 class="text-lg font-bold text-gray-900 uppercase border-b border-gray-200 pb-2">Proteger
                                o Ambiente</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Assumimos o compromisso de reduzir o impacto ambiental das nossas operações através da
                                utilização eficiente dos recursos, da redução do desperdício e da promoção de práticas
                                mais sustentáveis em toda a cadeia de abastecimento. Trabalhamos continuamente para
                                melhorar os processos internos, incentivar a reciclagem, reduzir o consumo de materiais
                                descartáveis e promover soluções que contribuam para um ambiente mais limpo para as
                                gerações futuras.
                            </p>
                        </div>

                        <!-- Pilar 2 -->
                        <div class="bg-gray-50/80 border border-gray-100 p-6 space-y-3">
                            <h3 class="text-lg font-bold text-gray-900 uppercase border-b border-gray-200 pb-2">Promover
                                Produtos de Qualidade</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                A qualidade começa na origem. Selecionamos cuidadosamente os nossos fornecedores e
                                privilegiamos produtos frescos, seguros e produzidos de acordo com elevados padrões de
                                qualidade. Acreditamos que oferecer alimentos frescos e de confiança é também uma forma
                                de contribuir para o bem-estar e para uma alimentação mais saudável das famílias.
                            </p>
                        </div>

                        <!-- Pilar 3 -->
                        <div class="bg-gray-50/80 border border-gray-100 p-6 space-y-3">
                            <h3 class="text-lg font-bold text-gray-900 uppercase border-b border-gray-200 pb-2">Apoiar
                                as Comunidades</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Crescemos juntamente com as comunidades onde estamos presentes. Valorizamos fornecedores
                                locais, apoiamos iniciativas comunitárias e procuramos gerar oportunidades que
                                contribuam para o desenvolvimento económico e social das regiões onde operamos. A
                                proximidade com os nossos clientes e parceiros permite-nos compreender melhor as suas
                                necessidades e criar relações duradouras baseadas na confiança e no respeito.
                            </p>
                        </div>

                        <!-- Pilar 4 -->
                        <div class="bg-gray-50/80 border border-gray-100 p-6 space-y-3">
                            <h3 class="text-lg font-bold text-gray-900 uppercase border-b border-gray-200 pb-2">
                                Valorizar as Pessoas</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Os nossos colaboradores são um dos principais pilares da Frasmart. Promovemos um
                                ambiente de trabalho seguro, inclusive e respeitador, onde cada pessoa é incentivada a
                                desenvolver o seu talento e a crescer profissionalmente. Acreditamos que equipas
                                motivadas e valorizadas proporcionam um melhor serviço aos nossos clientes e contribuem
                                para o sucesso sustentável da empresa.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Section 3: As nossas prioridades -->
                <div class="space-y-6 pt-4">
                    <div class="border-b border-gray-100 pb-4">
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 uppercase">As Nossas Prioridades
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="bg-white border border-gray-200 p-6 space-y-2 shadow-sm">
                            <h4 class="font-extrabold text-gray-900 text-sm uppercase">Redução do desperdício alimentar
                            </h4>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Implementamos processos de gestão eficientes para minimizar perdas ao longo da cadeia de
                                abastecimento e incentivar um consumo mais consciente, aproveitando melhor os recursos
                                disponíveis.
                            </p>
                        </div>

                        <div class="bg-white border border-gray-200 p-6 space-y-2 shadow-sm">
                            <h4 class="font-extrabold text-gray-900 text-sm uppercase">Eficiência operacional</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Investimos continuamente na melhoria dos nossos processos para reduzir consumos
                                desnecessários de energia, água e materiais, tornando as nossas operações cada vez mais
                                eficientes.
                            </p>
                        </div>

                        <div class="bg-white border border-gray-200 p-6 space-y-2 shadow-sm">
                            <h4 class="font-extrabold text-gray-900 text-sm uppercase">Compras responsáveis</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Construímos relações de longo prazo com fornecedores que partilham os nossos valores de
                                qualidade, ética, responsabilidade e respeito pelas pessoas e pelo ambiente.
                            </p>
                        </div>

                        <div class="bg-white border border-gray-200 p-6 space-y-2 shadow-sm">
                            <h4 class="font-extrabold text-gray-900 text-sm uppercase">Desenvolvimento local</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Sempre que possível, privilegiamos produtos e parceiros locais, contribuindo para
                                fortalecer a economia nacional e criar oportunidades de crescimento para empresas e
                                produtores.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Navigation link -->
                <div class="pt-6 border-t border-gray-100 flex justify-between items-center">
                    <a href="{{ route('about.index') }}"
                        class="bg-[#45B500] hover:bg-[#3a9900] text-white px-6 py-2.5 rounded-xl font-bold text-sm transition shadow-sm inline-block">
                        Conheça a nossa Empresa
                    </a>
                </div>

            </div>
        </div>
    </section>
</x-frontend.layout>
