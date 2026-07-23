<x-frontend.layout>
    <x-frontend.page-header title="Sobre Nós" subtitle="Servindo Angola com Coração" image="assets/img/slider1.png" />

    <section class="py-16 md:py-24 bg-gray-50/50 w-full min-h-[60vh] overflow-hidden">
        <div class="w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[1528px] mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Sidebar Tabs Navigation -->
                <div class="lg:col-span-4 bg-white border border-gray-100 shadow-md rounded-3xl p-6 space-y-2">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest px-3 mb-4">Secções</h3>
                    
                    <nav class="flex flex-col space-y-1">
                        <button onclick="switchTab('missao-valores')" id="tab-btn-missao-valores"
                            class="tab-btn w-full text-left px-4 py-3 rounded-2xl text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200 flex items-center gap-3 bg-green-50/40 text-[#45B500] border-l-4 border-[#45B500]">
                            <i class="fas fa-bullseye w-5 text-center text-xs"></i> Missão, Visão e Valores
                        </button>
                        
                        <button onclick="switchTab('produtos-nacionais')" id="tab-btn-produtos-nacionais"
                            class="tab-btn w-full text-left px-4 py-3 rounded-2xl text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200 flex items-center gap-3">
                            <i class="fas fa-seedling w-5 text-center text-xs"></i> Produtos Nacionais
                        </button>
                        
                        <button onclick="switchTab('cartao-fresmart')" id="tab-btn-cartao-fresmart"
                            class="tab-btn w-full text-left px-4 py-3 rounded-2xl text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200 flex items-center gap-3">
                            <i class="far fa-credit-card w-5 text-center text-xs"></i> Cartão Fresmart
                        </button>
                        
                        <button onclick="switchTab('fres-online')" id="tab-btn-fres-online"
                            class="tab-btn w-full text-left px-4 py-3 rounded-2xl text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200 flex items-center gap-3">
                            <i class="fas fa-shopping-basket w-5 text-center text-xs"></i> Fres Online
                        </button>
                        
                        <button onclick="switchTab('armazem')" id="tab-btn-armazem"
                            class="tab-btn w-full text-left px-4 py-3 rounded-2xl text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200 flex items-center gap-3">
                            <i class="fas fa-warehouse w-5 text-center text-xs"></i> Nosso Armazém
                        </button>
                        
                        <button onclick="switchTab('empregos')" id="tab-btn-empregos"
                            class="tab-btn w-full text-left px-4 py-3 rounded-2xl text-sm font-bold text-gray-700 hover:bg-green-50/50 hover:text-[#45B500] transition-all duration-200 flex items-center gap-3">
                            <i class="fas fa-user-tie w-5 text-center text-xs"></i> Empregos (Vagas)
                        </button>
                    </nav>
                </div>
                
                <!-- Tabs Contents Area -->
                <div class="lg:col-span-8 bg-white border border-gray-100 shadow-md rounded-3xl p-8 min-h-[400px] relative">
                    
                    <!-- Tab: Missão, Visão e Valores -->
                    <div id="tab-content-missao-valores" class="tab-pane space-y-6">
                        <div class="border-b border-gray-50 pb-4 mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 uppercase">Missão, Visão e Valores</h2>
                            <p class="text-sm text-gray-500 mt-1">O propósito que nos move todos os dias.</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100">
                                <h4 class="font-bold text-gray-900 mb-2.5 flex items-center gap-2">
                                    <i class="fas fa-bullseye text-[#45B500]"></i> Missão
                                </h4>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    Servir Angola com dedicação, oferecendo produtos de excelência e garantindo a satisfação plena dos nossos clientes em cada visita.
                                </p>
                            </div>
                            <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100">
                                <h4 class="font-bold text-gray-900 mb-2.5 flex items-center gap-2">
                                    <i class="fas fa-eye text-[#45B500]"></i> Visão
                                </h4>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    Ser a marca de referência em supermercados em Angola, reconhecida pela frescura, variedade e compromisso com as comunidades.
                                </p>
                            </div>
                        </div>
                        <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100">
                            <h4 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                                <i class="fas fa-heart text-[#45B500]"></i> Valores que Defendemos
                            </h4>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                <div class="p-3 bg-white border border-gray-100 rounded-xl flex items-center gap-2">
                                    <i class="fas fa-check-circle text-green-500 text-sm"></i>
                                    <span class="text-xs font-bold text-gray-700">Proximidade</span>
                                </div>
                                <div class="p-3 bg-white border border-gray-100 rounded-xl flex items-center gap-2">
                                    <i class="fas fa-check-circle text-green-500 text-sm"></i>
                                    <span class="text-xs font-bold text-gray-700">Confiança</span>
                                </div>
                                <div class="p-3 bg-white border border-gray-100 rounded-xl flex items-center gap-2">
                                    <i class="fas fa-check-circle text-green-500 text-sm"></i>
                                    <span class="text-xs font-bold text-gray-700">Qualidade</span>
                                </div>
                                <div class="p-3 bg-white border border-gray-100 rounded-xl flex items-center gap-2">
                                    <i class="fas fa-check-circle text-green-500 text-sm"></i>
                                    <span class="text-xs font-bold text-gray-700">Rigor</span>
                                </div>
                                <div class="p-3 bg-white border border-gray-100 rounded-xl flex items-center gap-2">
                                    <i class="fas fa-check-circle text-green-500 text-sm"></i>
                                    <span class="text-xs font-bold text-gray-700">Sustentabilidade</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab: Produtos Nacionais -->
                    <div id="tab-content-produtos-nacionais" class="tab-pane space-y-6 hidden">
                        <div class="border-b border-gray-50 pb-4 mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 uppercase">Produtos Nacionais</h2>
                            <p class="text-sm text-gray-500 mt-1">Valorizar o que é produzido em Angola.</p>
                        </div>
                        <div class="space-y-4 text-sm text-gray-600 leading-relaxed">
                            <p>
                                Na **Fresmart**, temos um forte compromisso com a economia local e os produtores angolanos. Acreditamos que a força do nosso país reside nas nossas terras e na dedicação da nossa gente.
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                                <div class="border border-gray-100 rounded-2xl overflow-hidden shadow-sm">
                                    <div class="bg-green-600 px-4 py-3 text-white font-bold text-xs uppercase tracking-wider">
                                        Frescura Local
                                    </div>
                                    <div class="p-4 space-y-2">
                                        <p class="text-xs text-gray-600">Trabalhamos diretamente com pequenos e médios agricultores de diversas províncias para trazer legumes e frutas colhidos recentemente até às nossas prateleiras.</p>
                                    </div>
                                </div>
                                <div class="border border-gray-100 rounded-2xl overflow-hidden shadow-sm">
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

                    <!-- Tab: Cartão Fresmart -->
                    <div id="tab-content-cartao-fresmart" class="tab-pane space-y-6 hidden">
                        <div class="border-b border-gray-50 pb-4 mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 uppercase">Cartão Fresmart</h2>
                            <p class="text-sm text-gray-500 mt-1">O seu passaporte para descontos ainda maiores.</p>
                        </div>
                        <div class="flex flex-col md:flex-row gap-8 items-center bg-gray-50/50 p-6 rounded-3xl border border-gray-100">
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
                                    <li class="flex items-center gap-2"><i class="fas fa-check text-green-500 text-sm"></i> Descontos diretos em produtos selecionados do folheto.</li>
                                    <li class="flex items-center gap-2"><i class="fas fa-check text-green-500 text-sm"></i> Acumulação de saldo convertível para compras futuras.</li>
                                    <li class="flex items-center gap-2"><i class="fas fa-check text-green-500 text-sm"></i> Ofertas personalizadas no dia de aniversário.</li>
                                </ul>
                                <p class="text-[11px] text-gray-400">Pode solicitar o seu cartão de fidelidade gratuitamente em qualquer balcão de atendimento das nossas lojas físicas.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tab: Fres Online -->
                    <div id="tab-content-fres-online" class="tab-pane space-y-6 hidden">
                        <div class="border-b border-gray-50 pb-4 mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 uppercase">Fres Online</h2>
                            <p class="text-sm text-gray-500 mt-1">A loja online da Fresmart à distância de um clique.</p>
                        </div>
                        <div class="space-y-6 text-sm text-gray-600 leading-relaxed">
                            <p>
                                Com a **Fres Online**, pode realizar as suas compras de supermercado com total comodidade e segurança. Tenha acesso a todo o nosso catálogo a partir do seu telemóvel ou computador.
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100 flex flex-col justify-between">
                                    <div class="space-y-2">
                                        <i class="fas fa-shopping-cart text-green-600 text-lg"></i>
                                        <h5 class="font-bold text-gray-900 text-xs">Carrinho Simples</h5>
                                        <p class="text-[11px] text-gray-500 leading-normal">Selecione produtos frescos e mercearia de forma intuitiva.</p>
                                    </div>
                                </div>
                                <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100 flex flex-col justify-between">
                                    <div class="space-y-2">
                                        <i class="fas fa-truck text-green-600 text-lg"></i>
                                        <h5 class="font-bold text-gray-900 text-xs">Entregas ao Domicílio</h5>
                                        <p class="text-[11px] text-gray-500 leading-normal">Escolha o horário mais conveniente e receba as suas compras em casa.</p>
                                    </div>
                                </div>
                                <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100 flex flex-col justify-between">
                                    <div class="space-y-2">
                                        <i class="fas fa-store text-green-600 text-lg"></i>
                                        <h5 class="font-bold text-gray-900 text-xs">Click & Collect</h5>
                                        <p class="text-[11px] text-gray-500 leading-normal">Faça a sua encomenda online e recolha de forma rápida na loja selecionada.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab: Nosso Armazém -->
                    <div id="tab-content-armazem" class="tab-pane space-y-6 hidden">
                        <div class="border-b border-gray-50 pb-4 mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 uppercase">Nosso Armazém</h2>
                            <p class="text-sm text-gray-500 mt-1">Distribuição de alta qualidade e cadeia de frio.</p>
                        </div>
                        <div class="space-y-6 text-sm text-gray-600 leading-relaxed">
                            <p>
                                A espinha dorsal da nossa promessa de frescura é a nossa central de armazenamento e distribuição. Equipado com as mais modernas tecnologias de conservação a frio, o nosso armazém assegura o tratamento adequado para cada categoria de alimento.
                            </p>
                            <div class="flex flex-col md:flex-row gap-6 items-center pt-2">
                                <div class="space-y-3 flex-1">
                                    <h4 class="font-bold text-gray-800 text-sm">Garantia de Qualidade</h4>
                                    <p class="text-xs text-gray-500">Cada produto que entra no nosso centro de distribuição passa por um rigoroso controlo de qualidade e temperatura antes de ser despachado para as lojas.</p>
                                </div>
                                <div class="space-y-3 flex-1">
                                    <h4 class="font-bold text-gray-800 text-sm">Frio Controlado</h4>
                                    <p class="text-xs text-gray-500">Câmaras frigoríficas específicas para carnes, laticínios e hortícolas garantem que a cadeia de frio não se rompe em nenhuma fase da logística.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab: Empregos (Vagas) -->
                    <div id="tab-content-empregos" class="tab-pane space-y-6 hidden">
                        <div class="border-b border-gray-50 pb-4 mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 uppercase">Trabalhe Connosco</h2>
                            <p class="text-sm text-gray-500 mt-1">Quer fazer parte da família Fresmart? Submeta a sua candidatura!</p>
                        </div>
                        
                        <!-- AJAX Success Message Alert -->
                        <div id="vacancy-success-alert" class="hidden bg-green-50 border border-green-200 text-green-800 p-4 rounded-2xl text-sm font-semibold mb-6 flex items-center gap-3">
                            <i class="fas fa-check-circle text-green-500 text-lg"></i>
                            <div>
                                Candidatura submetida com sucesso! Entraremos em contacto caso o seu perfil corresponda às nossas necessidades.
                            </div>
                        </div>

                        <!-- AJAX Error Alert -->
                        <div id="vacancy-error-alert" class="hidden bg-red-50 border border-red-200 text-red-800 p-4 rounded-2xl text-sm font-semibold mb-6">
                            Ocorreu um erro ao submeter a candidatura. Verifique os dados inseridos.
                        </div>

                        <!-- Vacancy Form -->
                        <form id="vacancy-submit-form" onsubmit="handleVacancySubmit(event)" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Nome Completo *</label>
                                    <input type="text" name="name" required placeholder="Seu nome completo"
                                        class="w-full border border-gray-200 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:outline-none transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">E-mail *</label>
                                    <input type="email" name="email" required placeholder="seuemail@exemplo.com"
                                        class="w-full border border-gray-200 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:outline-none transition-colors">
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Telefone *</label>
                                    <input type="text" name="phone" required placeholder="+244..."
                                        class="w-full border border-gray-200 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:outline-none transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Vaga / Função Desejada *</label>
                                    <select name="position" required
                                        class="w-full border border-gray-200 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:outline-none transition-colors bg-white">
                                        <option value="">Selecione uma função</option>
                                        <option value="Operador de Caixa">Operador de Caixa</option>
                                        <option value="Repositor de Mercadorias">Repositor de Mercadorias</option>
                                        <option value="Atendimento de Balcão (Talho/Padaria)">Atendimento de Balcão (Talho/Padaria)</option>
                                        <option value="Ajudante de Armazém">Ajudante de Armazém</option>
                                        <option value="Outra Posição">Outra Posição</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Carregar Currículo (PDF, DOC, DOCX) *</label>
                                <input type="file" name="cv" accept=".pdf,.doc,.docx" required
                                    class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer">
                                <p class="text-[10px] text-gray-400 mt-1">Tamanho máximo aceite: 5MB.</p>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Mensagem de Apresentação / Notas (opcional)</label>
                                <textarea name="cover_letter" rows="4" placeholder="Fale um pouco sobre si ou experiências anteriores..."
                                    class="w-full border border-gray-200 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:outline-none transition-colors"></textarea>
                            </div>

                            <div class="pt-4 flex justify-end">
                                <button type="submit" id="btn-submit-vacancy"
                                    class="bg-[#45B500] hover:bg-[#3a9900] text-white font-bold py-3 px-8 rounded-2xl transition-all duration-300 shadow-md flex items-center gap-2 cursor-pointer">
                                    <span>Submeter Candidatura</span>
                                </button>
                            </div>
                        </form>
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

            // AJAX Vacancy Submission
            function handleVacancySubmit(event) {
                event.preventDefault();

                var form = document.getElementById('vacancy-submit-form');
                var submitBtn = document.getElementById('btn-submit-vacancy');
                var successAlert = document.getElementById('vacancy-success-alert');
                var errorAlert = document.getElementById('vacancy-error-alert');

                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span>A enviar...</span> <i class="fas fa-spinner fa-spin text-sm"></i>';
                successAlert.classList.add('hidden');
                errorAlert.classList.add('hidden');

                var formData = new FormData(form);

                fetch("{{ route('candidatura.submit') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(function(res) {
                    return res.json();
                })
                .then(function(data) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<span>Submeter Candidatura</span>';
                    
                    if (data.success) {
                        successAlert.classList.remove('hidden');
                        form.reset();
                    } else {
                        errorAlert.classList.remove('hidden');
                    }
                })
                .catch(function(err) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<span>Submeter Candidatura</span>';
                    errorAlert.classList.remove('hidden');
                    console.error("Submission error: ", err);
                });
            }
        </script>
    </x-slot:scripts>
</x-frontend.layout>
