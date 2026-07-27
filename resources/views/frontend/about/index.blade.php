<x-frontend.layout>
    <div class="bg-white border-b border-gray-100 py-6">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
            <x-frontend.breadcrumbs :items="[['label' => 'Quem Somos']]" />
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 uppercase mt-1">Quem Somos</h1>
            <p class="text-sm text-gray-500 mt-1">Conheça a nossa empresa, o nosso percurso histórico, os pilares e o nosso sortido.</p>
        </div>
    </div>

    <section class="py-12 md:py-16 bg-gray-50/50 w-full min-h-[60vh] overflow-hidden">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Sidebar Tabs Navigation -->
                <div class="lg:col-span-4 bg-white border border-gray-100 shadow-md p-6 space-y-2">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest px-3 mb-4">Secções</h3>
                    
                    <nav class="flex flex-col space-y-1">
                        <button onclick="switchTab('empresa')" id="tab-btn-empresa"
                            class="tab-btn w-full text-left px-4 py-3 rounded-2xl text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200 bg-green-50/40 text-[#45B500] border-l-4 border-[#45B500]">
                            A Empresa
                        </button>

                        <button onclick="switchTab('missao-visao')" id="tab-btn-missao-visao"
                            class="tab-btn w-full text-left px-4 py-3 rounded-2xl text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200">
                            Missão e Visão
                        </button>

                        <button onclick="switchTab('sortido')" id="tab-btn-sortido"
                            class="tab-btn w-full text-left px-4 py-3 rounded-2xl text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200">
                            O Nosso Sortido
                        </button>

                        <button onclick="switchTab('numeros')" id="tab-btn-numeros"
                            class="tab-btn w-full text-left px-4 py-3 rounded-2xl text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200">
                            Fresmart em Números
                        </button>

                        <button onclick="switchTab('historia')" id="tab-btn-historia"
                            class="tab-btn w-full text-left px-4 py-3 rounded-2xl text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200">
                            A Nossa História
                        </button>
                        
                        <button onclick="switchTab('produtos-nacionais')" id="tab-btn-produtos-nacionais"
                            class="tab-btn w-full text-left px-4 py-3 rounded-2xl text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200">
                            Produtos Nacionais
                        </button>
                        
                        <button onclick="switchTab('cartao-fresmart')" id="tab-btn-cartao-fresmart"
                            class="tab-btn w-full text-left px-4 py-3 rounded-2xl text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200">
                            Cartão Fresmart
                        </button>
                        
                        <button onclick="switchTab('fres-online')" id="tab-btn-fres-online"
                            class="tab-btn w-full text-left px-4 py-3 rounded-2xl text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200">
                            Fres Online
                        </button>
                        
                        <button onclick="switchTab('armazem')" id="tab-btn-armazem"
                            class="tab-btn w-full text-left px-4 py-3 rounded-2xl text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200">
                            Nosso Armazém
                        </button>

                        <div class="border-t border-gray-100 my-2 pt-2"></div>

                        <a href="{{ route('sustainability.index') }}"
                            class="w-full text-left px-4 py-3 rounded-2xl text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200">
                            Sustentabilidade
                        </a>

                        <a href="{{ route('social.responsibility.index') }}"
                            class="w-full text-left px-4 py-3 rounded-2xl text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200">
                            Responsabilidade Social
                        </a>

                        <a href="{{ route('posts.index') }}"
                            class="w-full text-left px-4 py-3 rounded-2xl text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200">
                            Notícias
                        </a>

                        <a href="{{ route('careers.index') }}"
                            class="w-full text-left px-4 py-3 rounded-2xl text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200">
                            Trabalhe Connosco
                        </a>

                        <a href="{{ route('contacts.index') }}"
                            class="w-full text-left px-4 py-3 rounded-2xl text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200">
                            Contactos
                        </a>
                    </nav>
                </div>
                
                <!-- Tabs Contents Area -->
                <div class="lg:col-span-8 bg-white border border-gray-100 shadow-md p-8 min-h-[400px] relative">
                    
                    <!-- Tab 1: A Empresa -->
                    <div id="tab-content-empresa" class="tab-pane space-y-6">
                        <div class="border-b border-gray-50 pb-4 mb-6">
                            <h2 class="text-3xl font-extrabold text-gray-900 uppercase">A Empresa</h2>
                        </div>
                        
                        <div class="overflow-hidden border border-gray-100">
                            <img src="{{ asset('assets/img/fresmart_empresa.png') }}" alt="Supermercado Fresmart" class="w-full h-56 md:h-72 object-cover">
                        </div>

                        <div class="space-y-4 text-sm text-gray-600 leading-relaxed">
                            <p>
                                A <strong>Fresmart</strong> é uma marca comprometida em oferecer aos seus clientes produtos frescos, qualidade garantida e uma experiência de compra prática, confortável e acessível. Trabalhamos diariamente para disponibilizar uma seleção cuidada de produtos alimentares e essenciais, sempre com foco na frescura, na confiança e na satisfação de quem nos visita.
                            </p>
                            <p>
                                Na Fresmart, acreditamos que fazer compras deve ser uma experiência simples e agradável. Por isso, apostamos numa oferta diversificada que inclui frutas e legumes frescos, talho, padaria, produtos de mercearia, bebidas e muito mais, selecionados de fornecedores de confiança e preparados para responder às necessidades das famílias angolanas.
                            </p>
                            <p>
                                Guiados pelo compromisso de servir cada cliente com excelência, investimos continuamente na qualidade dos nossos produtos, na modernização das nossas lojas e na formação das nossas equipas. O profissionalismo e a dedicação dos nossos colaboradores refletem-se diariamente num atendimento próximo, eficiente e orientado para as necessidades de cada cliente.
                            </p>
                            <p class="font-medium text-gray-800 bg-green-50/60 p-4 border border-green-100/60">
                                Mais do que um supermercado, a Fresmart é um parceiro do dia a dia. Continuamos a crescer com o objetivo de estar cada vez mais perto das comunidades onde estamos presentes, oferecendo conveniência, variedade e preços competitivos, sem nunca abdicar da qualidade que nos distingue.
                            </p>
                        </div>
                    </div>

                    <!-- Tab 2: Missão e Visão -->
                    <div id="tab-content-missao-visao" class="tab-pane space-y-6 hidden">
                        <div class="border-b border-gray-50 pb-4 mb-6">
                            <h2 class="text-3xl font-extrabold text-gray-900 uppercase">Missão e Visão</h2>
                            <p class="text-sm text-gray-500 mt-1">Os pilares estratégicos que orientam a nossa jornada em Angola.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-50/70 p-6 border border-gray-100 space-y-3 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 uppercase">A nossa Missão</h3>
                                    <p class="text-sm text-gray-600 leading-relaxed mt-3">
                                        A nossa missão é proporcionar uma experiência de compra que inspire confiança em cada visita, reforçando o compromisso de colocar sempre os nossos clientes em primeiro lugar e de contribuir para uma alimentação mais prática, equilibrada e acessível para todos.
                                    </p>
                                </div>
                            </div>

                            <div class="bg-gray-50/70 p-6 border border-gray-100 space-y-3 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 uppercase">A nossa Visão</h3>
                                    <p class="text-sm text-gray-600 leading-relaxed mt-3">
                                        Ser reconhecida como a rede de supermercados líder em frescura, proximidade e inovação no retalho alimentar em Angola, impulsionando a produção nacional e o bem-estar social.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50/50 p-6 border border-gray-100 space-y-4 mt-6">
                            <h4 class="font-bold text-gray-900 text-base uppercase">Valores que Defendemos</h4>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                <div class="p-3.5 bg-white border border-gray-100 flex items-center gap-2.5 shadow-sm">
                                    <span class="text-xs font-bold text-gray-800">Proximidade</span>
                                </div>
                                <div class="p-3.5 bg-white border border-gray-100 flex items-center gap-2.5 shadow-sm">
                                    <span class="text-xs font-bold text-gray-800">Confiança</span>
                                </div>
                                <div class="p-3.5 bg-white border border-gray-100 flex items-center gap-2.5 shadow-sm">
                                    <span class="text-xs font-bold text-gray-800">Qualidade</span>
                                </div>
                                <div class="p-3.5 bg-white border border-gray-100 flex items-center gap-2.5 shadow-sm">
                                    <span class="text-xs font-bold text-gray-800">Rigor</span>
                                </div>
                                <div class="p-3.5 bg-white border border-gray-100 flex items-center gap-2.5 shadow-sm">
                                    <span class="text-xs font-bold text-gray-800">Sustentabilidade</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 3: O Nosso Sortido -->
                    <div id="tab-content-sortido" class="tab-pane space-y-6 hidden">
                        <div class="border-b border-gray-50 pb-4 mb-6">
                            <h2 class="text-3xl font-extrabold text-gray-900 uppercase">O Nosso Sortido</h2>
                        </div>

                        <div class="overflow-hidden border border-gray-100">
                            <img src="{{ asset('assets/img/fresmart_sortido.png') }}" alt="Produtos Frescos Fresmart" class="w-full h-56 md:h-72 object-cover">
                        </div>

                        <div class="space-y-4 text-sm text-gray-600 leading-relaxed">
                            <p>
                                Na <strong>Fresmart</strong>, acreditamos que qualidade, frescura e variedade devem estar ao alcance de todos. É por isso que selecionamos cuidadosamente os nossos produtos, garantindo um sortido completo que responde às necessidades do dia a dia das famílias, sempre com a melhor relação entre qualidade e preço.
                            </p>
                            <p>
                                As nossas lojas oferecem uma ampla seleção de produtos frescos, frutas e legumes, talho, padaria, mercearia, bebidas, produtos de higiene, limpeza e artigos essenciais para o lar. Trabalhamos diariamente para garantir que encontra tudo o que precisa num só lugar, com a confiança e a qualidade que caracterizam a Fresmart.
                            </p>
                            <p>
                                Além da nossa oferta permanente, disponibilizamos regularmente campanhas e promoções especiais, proporcionando aos nossos clientes ainda mais oportunidades para poupar sem abdicar da qualidade. O nosso compromisso é continuar a evoluir o sortido, acompanhando as preferências dos consumidores e oferecendo produtos que tornam cada compra mais prática, completa e vantajosa.
                            </p>
                        </div>
                    </div>

                    <!-- Tab 4: Fresmart em Números -->
                    <div id="tab-content-numeros" class="tab-pane space-y-6 hidden">
                        <div class="border-b border-gray-50 pb-4 mb-6">
                            <h2 class="text-3xl font-extrabold text-gray-900 uppercase">Fresmart em Números</h2>
                            <p class="text-sm text-gray-500 mt-1">A dimensão do nosso impacto diário no país.</p>
                        </div>

                        <div class="grid grid-cols-2 lg:grid-cols-2 gap-6 pt-2">
                            <div class="bg-gradient-to-br from-green-500 to-[#1b5314] p-8 text-white shadow-lg space-y-2 text-center">
                                <div class="text-4xl md:text-5xl font-black tracking-tight">+18</div>
                                <div class="text-xs md:text-sm font-bold uppercase tracking-wider text-white/90">Lojas em Angola</div>
                            </div>

                            <div class="bg-gray-900 p-8 text-white shadow-lg space-y-2 text-center">
                                <div class="text-4xl md:text-5xl font-black tracking-tight text-[#45B500]">+650</div>
                                <div class="text-xs md:text-sm font-bold uppercase tracking-wider text-white/90">Colaboradores</div>
                            </div>

                            <div class="bg-gray-900 p-8 text-white shadow-lg space-y-2 text-center">
                                <div class="text-4xl md:text-5xl font-black tracking-tight text-[#45B500]">+8.500</div>
                                <div class="text-xs md:text-sm font-bold uppercase tracking-wider text-white/90">Produtos no Sortido</div>
                            </div>

                            <div class="bg-gradient-to-br from-green-500 to-[#1b5314] p-8 text-white shadow-lg space-y-2 text-center">
                                <div class="text-4xl md:text-5xl font-black tracking-tight">+150</div>
                                <div class="text-xs md:text-sm font-bold uppercase tracking-wider text-white/90">Fornecedores Nacionais</div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 5: A Nossa História -->
                    <div id="tab-content-historia" class="tab-pane space-y-6 hidden">
                        <div class="border-b border-gray-50 pb-4 mb-6">
                            <h2 class="text-3xl font-extrabold text-gray-900 uppercase">A Nossa História</h2>
                            <p class="text-sm text-gray-500 mt-1">O caminho percorrido ao serviço das famílias angolanas.</p>
                        </div>

                        <div class="overflow-hidden border border-gray-100">
                            <img src="{{ asset('assets/img/fresmart_historia.png') }}" alt="Fresmart História" class="w-full h-56 md:h-72 object-cover">
                        </div>

                        <!-- Timeline Cards -->
                        <div class="space-y-6 relative before:absolute before:inset-0 before:left-6 before:w-0.5 before:bg-green-200 pt-4">
                            <!-- Step 2014 -->
                            <div class="relative flex items-start gap-6 pl-12">
                                <div class="bg-gray-50/80 p-5 border border-gray-100 space-y-1 w-full">
                                    <span class="text-xs font-black text-[#45B500] uppercase tracking-wider">2014</span>
                                    <h4 class="text-base font-bold text-gray-900">Início da Operação</h4>
                                    <p class="text-xs text-gray-600 leading-relaxed">
                                        Abertura das primeiras lojas em Luanda, com o firme compromisso de trazer produtos alimentares frescos e acessíveis para as famílias angolanas.
                                    </p>
                                </div>
                            </div>

                            <!-- Step 2018 -->
                            <div class="relative flex items-start gap-6 pl-12">
                                <div class="bg-gray-50/80 p-5 border border-gray-100 space-y-1 w-full">
                                    <span class="text-xs font-black text-[#45B500] uppercase tracking-wider">2018</span>
                                    <h4 class="text-base font-bold text-gray-900">Expansão de Lojas e Lançamento do Cartão Poupança</h4>
                                    <p class="text-xs text-gray-600 leading-relaxed">
                                        Alcançamos a marca de 10 lojas ativas e apresentamos o Cartão Poupança Fresmart, permitindo poupança real a milhares de agregados familiares.
                                    </p>
                                </div>
                            </div>

                            <!-- Step 2022 -->
                            <div class="relative flex items-start gap-6 pl-12">
                                <div class="bg-gray-50/80 p-5 border border-gray-100 space-y-1 w-full">
                                    <span class="text-xs font-black text-[#45B500] uppercase tracking-wider">2022</span>
                                    <h4 class="text-base font-bold text-gray-900">Fortalecimento com Produtores Nacionais</h4>
                                    <p class="text-xs text-gray-600 leading-relaxed">
                                        Estreitamento de acordos diretos com parceiros agrícolas e produtores locais angolanos para fornecimento diário garantido, melhorando a qualidade dos frescos nas lojas.
                                    </p>
                                </div>
                            </div>

                            <!-- Step Presente -->
                            <div class="relative flex items-start gap-6 pl-12">
                                <div class="bg-green-50/80 p-5 border border-green-100 space-y-1 w-full">
                                    <span class="text-xs font-black text-green-700 uppercase tracking-wider">Presente</span>
                                    <h4 class="text-base font-bold text-gray-900">+18 Lojas e +650 Colaboradores</h4>
                                    <p class="text-xs text-gray-600 leading-relaxed">
                                        Hoje somos uma rede sólida em crescimento permanente, operando sob elevados padrões de serviço e focada em ser o parceiro mais fiável no dia a dia angolano.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 6: Produtos Nacionais -->
                    <div id="tab-content-produtos-nacionais" class="tab-pane space-y-6 hidden">
                        <div class="border-b border-gray-50 pb-4 mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 uppercase">Produtos Nacionais</h2>
                            <p class="text-sm text-gray-500 mt-1">Valorizar o que é produzido em Angola.</p>
                        </div>
                        <img src="https://images.unsplash.com/photo-1610348725531-843dff563e2c?auto=format&fit=crop&w=1200&q=80" alt="Produtos Nacionais Alimentos Frescos" class="w-full h-48 md:h-64 object-cover mb-6 shadow-sm">
                        <div class="space-y-4 text-sm text-gray-600 leading-relaxed">
                            <p>
                                Na <strong>Fresmart</strong>, temos um forte compromisso com a economia local e os produtores angolanos. Acreditamos que a força do nosso país reside nas nossas terras e na dedicação da nossa gente.
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                                <div class="border border-gray-100 overflow-hidden shadow-sm">
                                    <div class="bg-green-600 px-4 py-3 text-white font-bold text-xs uppercase tracking-wider">
                                        Frescura Local
                                    </div>
                                    <div class="p-4 space-y-2">
                                        <p class="text-xs text-gray-600">Trabalhamos diretamente com pequenos e médios agricultores de diversas províncias para trazer legumes e frutas colhidos recentemente até às nossas prateleiras.</p>
                                    </div>
                                </div>
                                <div class="border border-gray-100 overflow-hidden shadow-sm">
                                    <div class="bg-[#45B500] px-4 py-3 text-white font-bold text-xs uppercase tracking-wider">
                                        Apoio à Produção
                                    </div>
                                    <div class="p-4 space-y-2">
                                        <p class="text-xs text-gray-600">Garantimos acordos de compra justa, estimulando o crescimento económico interno e assegurando a melhor oferta para as famílias angolanas.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 7: Cartão Fresmart -->
                    <div id="tab-content-cartao-fresmart" class="tab-pane space-y-6 hidden">
                        <div class="border-b border-gray-50 pb-4 mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 uppercase">Cartão Fresmart</h2>
                            <p class="text-sm text-gray-500 mt-1">O seu passaporte para descontos ainda maiores.</p>
                        </div>
                        <img src="https://images.unsplash.com/photo-1556742049-0a67568d0490?auto=format&fit=crop&w=1200&q=80" alt="Cartão Fresmart Fidelidade" class="w-full h-48 md:h-64 object-cover mb-6 shadow-sm">
                        <div class="flex flex-col md:flex-row gap-8 items-center bg-gray-50/50 p-6 border border-gray-100">
                            <!-- Visual Card Mock -->
                            <div class="w-72 h-44 bg-gradient-to-br from-green-600 to-[#1b5314] rounded-2xl p-6 flex flex-col justify-between text-white shadow-xl relative overflow-hidden flex-shrink-0">
                                <div class="absolute right-0 top-0 w-24 h-24 bg-white/5 rounded-full blur-xl pointer-events-none"></div>
                                <div class="flex justify-between items-start">
                                    <span class="font-extrabold text-lg tracking-wider">FRESMART</span>
                                    <span class="text-[9px] bg-white/20 px-2 py-0.5 rounded-md font-bold uppercase tracking-widest">Fidelidade</span>
                                </div>
                                <div>
                                    <div class="text-[10px] text-white/70">NÚMERO DO CARTÃO</div>
                                    <div class="font-mono text-sm tracking-widest mt-0.5">8847 9920 3829 0019</div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <h3 class="font-extrabold text-gray-800 text-lg">Vantagens Exclusivas</h3>
                                <ul class="space-y-2 text-xs text-gray-600">
                                    <li class="flex items-center gap-2">Descontos diretos em produtos selecionados do folheto.</li>
                                    <li class="flex items-center gap-2">Acumulação de saldo convertível para compras futuras.</li>
                                    <li class="flex items-center gap-2">Ofertas personalizadas no dia de aniversário.</li>
                                </ul>
                                <p class="text-[11px] text-gray-400">Pode solicitar o seu cartão de fidelidade gratuitamente em qualquer balcão de atendimento das nossas lojas físicas.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 8: Fres Online -->
                    <div id="tab-content-fres-online" class="tab-pane space-y-6 hidden">
                        <div class="border-b border-gray-50 pb-4 mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 uppercase">Fres Online</h2>
                            <p class="text-sm text-gray-500 mt-1">A loja online da Fresmart à distância de um clique.</p>
                        </div>
                        <img src="https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?auto=format&fit=crop&w=1200&q=80" alt="Fres Online Compras de Supermercado" class="w-full h-48 md:h-64 object-cover mb-6 shadow-sm">
                        <div class="space-y-6 text-sm text-gray-600 leading-relaxed">
                            <p>
                                Com a <strong>Fres Online</strong>, pode realizar as suas compras de supermercado com total comodidade e segurança. Tenha acesso a todo o nosso catálogo a partir do seu telemóvel ou computador.
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-gray-50 p-5 border border-gray-100 flex flex-col justify-between">
                                    <div class="space-y-2">
                                        <h5 class="font-bold text-gray-900 text-xs uppercase">Carrinho Simples</h5>
                                        <p class="text-[11px] text-gray-500 leading-normal">Selecione produtos frescos e mercearia de forma intuitiva.</p>
                                    </div>
                                </div>
                                <div class="bg-gray-50 p-5 border border-gray-100 flex flex-col justify-between">
                                    <div class="space-y-2">
                                        <h5 class="font-bold text-gray-900 text-xs uppercase">Entregas ao Domicílio</h5>
                                        <p class="text-[11px] text-gray-500 leading-normal">Escolha o horário mais conveniente e receba as suas compras em casa.</p>
                                    </div>
                                </div>
                                <div class="bg-gray-50 p-5 border border-gray-100 flex flex-col justify-between">
                                    <div class="space-y-2">
                                        <h5 class="font-bold text-gray-900 text-xs uppercase">Click & Collect</h5>
                                        <p class="text-[11px] text-gray-500 leading-normal">Faça a sua encomenda online e recolha de forma rápida na loja selecionada.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 9: Nosso Armazém -->
                    <div id="tab-content-armazem" class="tab-pane space-y-6 hidden">
                        <div class="border-b border-gray-50 pb-4 mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 uppercase">Nosso Armazém</h2>
                            <p class="text-sm text-gray-500 mt-1">Distribuição de alta qualidade e cadeia de frio.</p>
                        </div>
                        <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1200&q=80" alt="Nosso Armazém Logística e Distribuição" class="w-full h-48 md:h-64 object-cover mb-6 shadow-sm">
                        <div class="space-y-6 text-sm text-gray-600 leading-relaxed">
                            <p>
                                A espinha dorsal da nossa promessa de frescura é a nossa central de armazenamento e distribuição. Equipado com as mais modernas tecnologias de conservação a frio, o nosso armazém assegura o tratamento adequado para cada categoria de alimento.
                            </p>
                            <div class="flex flex-col md:flex-row gap-6 items-center pt-2">
                                <div class="space-y-3 flex-1">
                                    <h4 class="font-bold text-gray-800 text-sm uppercase">Garantia de Qualidade</h4>
                                    <p class="text-xs text-gray-500">Cada produto que entra no nosso centro de distribuição passa por um rigoroso controlo de qualidade e temperatura antes de ser despachado para as lojas.</p>
                                </div>
                                <div class="space-y-3 flex-1">
                                    <h4 class="font-bold text-gray-800 text-sm uppercase">Frio Controlado</h4>
                                    <p class="text-xs text-gray-500">Câmaras frigoríficas específicas para carnes, laticínios e hortícolas garantem que a cadeia de frio não se rompe em nenhuma fase da logística.</p>
                                </div>
                            </div>
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
