<x-frontend.layout>
    <div class="bg-white border-b border-gray-100 py-6">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
            <x-frontend.breadcrumbs :items="[['label' => 'Quem Somos']]" />
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 uppercase mt-1">
                {{ $page->title ?? 'Quem Somos' }}</h1>
            <p class="text-sm text-gray-500 mt-1">
                {{ $page->subtitle ?? 'Conheça a nossa empresa, o nosso percurso histórico, os pilares e o nosso sortido.' }}
            </p>
        </div>
    </div>

    <section class="bg-white w-full min-h-[60vh] overflow-hidden">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                <!-- Sidebar Tabs Navigation -->
                <div class="lg:col-span-4 bg-white border border-gray-100 shadow-md p-6 space-y-2">
                    <h3 class="font-bold text-gray-400 uppercase tracking-widest px-3 mb-4">Secções</h3>

                    <nav class="flex flex-col space-y-1">
                        <button onclick="switchTab('empresa')" id="tab-btn-empresa"
                            class="tab-btn w-full text-left px-4 py-3 text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200 bg-green-50/40 text-[#45B500] border-l-4 border-[#45B500]">
                            A Empresa
                        </button>

                        <button onclick="switchTab('sortido')" id="tab-btn-sortido"
                            class="tab-btn w-full text-left px-4 py-3 text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200">
                            O Nosso Sortido
                        </button>

                        <button onclick="switchTab('historia')" id="tab-btn-historia"
                            class="tab-btn w-full text-left px-4 py-3 text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200">
                            A Nossa História
                        </button>

                        <button onclick="switchTab('armazem')" id="tab-btn-armazem"
                            class="tab-btn w-full text-left px-4 py-3 text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200">
                            Nosso Armazém
                        </button>
                    </nav>
                </div>

                <!-- Main Content Area -->
                <div class="lg:col-span-8 bg-white border border-gray-100 shadow-md p-8 md:p-12 space-y-12">

                    <!-- TAB 1: A Empresa -->
                    <div id="tab-content-empresa" class="tab-pane space-y-8">
                        <!-- Secção 1: Texto Institucional (CMS) -->
                        <div class="space-y-4">
                            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 uppercase">
                                {{ $page->content_title ?? 'A Empresa' }}
                            </h2>
                            @if ($page->section_image_1)
                                <div class="w-full h-64 md:h-80 overflow-hidden my-4 border border-gray-100">
                                    <img src="{{ asset(str_starts_with($page->section_image_1, 'http') ? $page->section_image_1 : $page->section_image_1) }}" class="w-full h-full object-cover">
                                </div>
                            @endif
                            <div class="space-y-4 text-sm md:text-base text-gray-600 leading-relaxed">
                                {!! nl2br(e($page->content)) !!}
                            </div>
                        </div>
                        
                        <!-- Secção 2: Missão e Visão -->
                        <div class="pt-8 border-t border-gray-100 space-y-6">
                            <div class="border-b border-gray-50 pb-4 mb-2">
                                <h3 class="text-2xl font-extrabold text-gray-900 uppercase">Missão e Visão</h3>
                                <p class="text-sm text-gray-500 mt-1">Os pilares estratégicos que orientam a nossa jornada em Angola.</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <h4 class="text-lg font-bold text-gray-900 uppercase">A nossa Missão</h4>
                                    <div class="text-sm text-gray-600 leading-relaxed">
                                        @if(!empty($page->extra_content_1))
                                            {!! nl2br(e($page->extra_content_1)) !!}
                                        @else
                                            <p>A nossa missão é proporcionar uma experiência de compra que inspire confiança em cada visita, reforçando o compromisso de colocar sempre os nossos clientes em primeiro lugar e de contribuir para uma alimentação mais prática, equilibrada e acessível para todos.</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <h4 class="text-lg font-bold text-gray-900 uppercase">A nossa Visão</h4>
                                    <div class="text-sm text-gray-600 leading-relaxed">
                                        @if(!empty($page->extra_content_2))
                                            {!! nl2br(e($page->extra_content_2)) !!}
                                        @else
                                            <p>Ser reconhecida como a rede de supermercados líder em frescura, proximidade e inovação no retalho alimentar em Angola, impulsionando a produção nacional e o bem-estar social.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Secção 3: Fresmart em Números -->
                        <div class="pt-8 border-t border-gray-100">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                                <div class="p-4 space-y-1">
                                    <div class="text-3xl md:text-4xl font-black text-[#45B500] tracking-tight">+18</div>
                                    <div class="font-bold uppercase tracking-wider text-gray-700">Lojas em Angola</div>
                                </div>

                                <div class="p-4 space-y-1">
                                    <div class="text-3xl md:text-4xl font-black text-[#45B500] tracking-tight">+650</div>
                                    <div class="font-bold uppercase tracking-wider text-gray-700">Colaboradores</div>
                                </div>

                                <div class="p-4 space-y-1">
                                    <div class="text-3xl md:text-4xl font-black text-[#45B500] tracking-tight">+8.500</div>
                                    <div class="font-bold uppercase tracking-wider text-gray-700">Produtos no Sortido</div>
                                </div>

                                <div class="p-4 space-y-1">
                                    <div class="text-3xl md:text-4xl font-black text-[#45B500] tracking-tight">+150</div>
                                    <div class="font-bold uppercase tracking-wider text-gray-700">Fornecedores Nacionais</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2: O Nosso Sortido -->
                    <div id="tab-content-sortido" class="tab-pane space-y-6 hidden">
                        <div class="border-b border-gray-50 pb-4 mb-6">
                            <h2 class="text-3xl font-extrabold text-gray-900 uppercase">O Nosso Sortido</h2>
                        </div>

                        <div class="overflow-hidden border border-gray-100">
                            <img src="{{ asset(str_starts_with($page->section_image_2 ?? '', 'http') ? $page->section_image_2 : ($page->section_image_2 ?: 'assets/img/fresmart_sortido.png')) }}" alt="Produtos Frescos Fresmart"
                                class="w-full h-56 md:h-72 object-cover">
                        </div>

                        <div class="space-y-4 text-sm text-gray-600 leading-relaxed">
                            @if(!empty($page->extra_content_3))
                                {!! nl2br(e($page->extra_content_3)) !!}
                            @else
                                <p>
                                    Na <strong>Fresmart</strong>, acreditamos que qualidade, frescura e variedade devem
                                    estar ao alcance de todos. É por isso que selecionamos cuidadosamente os nossos
                                    produtos, garantindo um sortido completo que responde às necessidades do dia a dia das
                                    famílias, sempre com a melhor relação entre qualidade e preço.
                                </p>
                                <p>
                                    As nossas lojas oferecem uma ampla seleção de produtos frescos, frutas e legumes, talho,
                                    padaria, mercearia, bebidas, produtos de higiene, limpeza e artigos essenciais para o
                                    lar. Trabalhamos diariamente para garantir que encontra tudo o que precisa num só lugar,
                                    com a confiança e a qualidade que caracterizam a Fresmart.
                                </p>
                                <p>
                                    Além da nossa oferta permanente, disponibilizamos regularmente campanhas e promoções
                                    especiais, proporcionando aos nossos clientes ainda mais oportunidades para poupar sem
                                    abdicar da qualidade. O nosso compromisso é continuar a evoluir o sortido, acompanhando
                                    as preferências dos consumidores e oferecendo produtos que tornam cada compra mais
                                    prática, completa e vantajosa.
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Tab 3: A Nossa História -->
                    <div id="tab-content-historia" class="tab-pane space-y-6 hidden">
                        <div class="border-b border-gray-50 pb-4 mb-6">
                            <h2 class="text-3xl font-extrabold text-gray-900 uppercase">A Nossa História</h2>
                            <p class="text-sm text-gray-500 mt-1">O caminho percorrido ao serviço das famílias angolanas.</p>
                        </div>

                        <div class="overflow-hidden border border-gray-100">
                            <img src="{{ asset(str_starts_with($page->section_image_3 ?? '', 'http') ? $page->section_image_3 : ($page->section_image_3 ?: 'assets/img/fresmart_historia.png')) }}" alt="Fresmart História"
                                class="w-full h-56 md:h-72 object-cover">
                        </div>

                        @if(!empty($page->extra_content_4))
                            <div class="space-y-4 text-sm text-gray-600 leading-relaxed mb-6">
                                {!! nl2br(e($page->extra_content_4)) !!}
                            </div>
                        @endif

                        @php
                            $timelineItems = (is_array($page->timeline) && count($page->timeline) > 0) ? $page->timeline : [
                                ['year' => '2014', 'title' => 'Início da Operação', 'description' => 'Abertura das primeiras lojas em Luanda, com o firme compromisso de trazer produtos alimentares frescos e acessíveis para as famílias angolanas.'],
                                ['year' => '2018', 'title' => 'Expansão de Lojas e Lançamento do Cartão Poupança', 'description' => 'Alcançamos a marca de 10 lojas ativas e apresentamos o Cartão Poupança Fresmart, permitindo poupança real a milhares de agregados familiares.'],
                                ['year' => '2022', 'title' => 'Fortalecimento com Produtores Nacionais', 'description' => 'Estreitamento de acordos diretos com parceiros agrícolas e produtores locais angolanos para fornecimento diário garantido, melhorando a qualidade dos frescos nas lojas.'],
                                ['year' => 'PRESENTE', 'title' => '+18 Lojas e +650 Colaboradores', 'description' => 'Hoje somos uma rede sólida em crescimento permanente, operando sob elevados padrões de serviço e focada em ser o parceiro mais fiável no dia a dia angolano.'],
                            ];
                        @endphp

                        <div class="space-y-6 relative before:absolute before:inset-0 before:left-6 before:w-0.5 before:bg-green-200 pt-4">
                            @foreach($timelineItems as $item)
                                <div class="relative flex items-start gap-6 pl-12">
                                    <div class="space-y-1 w-full">
                                        <span class="font-black text-[#45B500] uppercase tracking-wider">{{ $item['year'] ?? '' }}</span>
                                        <h4 class="text-base font-bold text-gray-900">{{ $item['title'] ?? '' }}</h4>
                                        <p class="text-sm text-gray-600 leading-relaxed">{{ $item['description'] ?? '' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tab 4: Nosso Armazém -->
                    <div id="tab-content-armazem" class="tab-pane space-y-6 hidden">
                        <div class="border-b border-gray-50 pb-4 mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 uppercase">Nosso Armazém</h2>
                            <p class="text-sm text-gray-500 mt-1">Distribuição de alta qualidade e cadeia de frio.</p>
                        </div>
                        <img src="{{ asset(str_starts_with($page->section_image_4 ?? '', 'http') ? $page->section_image_4 : ($page->section_image_4 ?: 'placeholder.png')) }}"
                            alt="Nosso Armazém Logística e Distribuição"
                            class="w-full h-48 md:h-64 object-cover mb-6 border border-gray-100">
                        <div class="space-y-6 text-sm text-gray-600 leading-relaxed">
                            @if(!empty($page->extra_content_5))
                                {!! nl2br(e($page->extra_content_5)) !!}
                            @else
                                <p>
                                    A espinha dorsal da nossa promessa de frescura é a nossa central de armazenamento e
                                    distribuição. Equipado com as mais modernas tecnologias de conservação a frio, o nosso
                                    armazém assegura o tratamento adequado para cada categoria de alimento.
                                </p>
                                <div class="flex flex-col md:flex-row gap-6 items-center pt-2">
                                    <div class="space-y-3 flex-1">
                                        <h4 class="font-bold text-gray-800 text-sm uppercase">Garantia de Qualidade</h4>
                                        <p class="text-gray-500">Cada produto que entra no nosso centro de
                                            distribuição passa por um rigoroso controlo de qualidade e temperatura antes de
                                            ser despachado para as lojas.</p>
                                    </div>
                                    <div class="space-y-3 flex-1">
                                        <h4 class="font-bold text-gray-800 text-sm uppercase">Frio Controlado</h4>
                                        <p class="text-gray-500">Câmaras frigoríficas específicas para carnes,
                                            laticínios e hortícolas garantem que a cadeia de frio não se rompe em nenhuma
                                            fase da logística.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript to toggle Tabs & AJAX Vacancy Submission -->
    <x-slot:scripts>
        <script>
            function switchTab(tabId) {
                // Hide all contents
                var panes = document.querySelectorAll('.tab-pane');
                panes.forEach(function(pane) {
                    pane.classList.add('hidden');
                });

                // Remove active classes from buttons
                var buttons = document.querySelectorAll('.tab-btn');
                buttons.forEach(function(btn) {
                    btn.classList.remove('bg-green-50/40', 'text-[#45B500]', 'border-l-4', 'border-[#45B500]');
                });

                // Show active content
                var activePane = document.getElementById('tab-content-' + tabId);
                if (activePane) {
                    activePane.classList.remove('hidden');
                }

                // Make button active
                var activeBtn = document.getElementById('tab-btn-' + tabId);
                if (activeBtn) {
                    activeBtn.classList.add('bg-green-50/40', 'text-[#45B500]', 'border-l-4', 'border-[#45B500]');
                }
            }
        </script>
    </x-slot:scripts>
</x-frontend.layout>
