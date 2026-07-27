<x-frontend.layout>
    <div class="bg-white border-b border-gray-100 py-6">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
            <x-frontend.breadcrumbs :items="[['label' => 'Quem Somos', 'url' => route('about.index')], ['label' => 'Trabalhe Connosco']]" />
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 uppercase mt-1">Trabalhe Connosco</h1>
            <p class="text-sm text-gray-500 mt-1">Faça parte da equipa que faz a diferença todos os dias.</p>
        </div>
    </div>

    <section class="py-12 md:py-16 bg-gray-50/50 w-full min-h-[60vh]">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10 space-y-12">
            
            <div class="bg-white border border-gray-100 shadow-sm p-8 md:p-12 space-y-10">

                <!-- Section 1: Construa o seu Futuro connosco -->
                <div class="space-y-6">
                    <div class="border-b border-gray-100 pb-4">
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 uppercase">Construa o seu Futuro connosco</h2>
                    </div>

                    <div class="overflow-hidden border border-gray-100">
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1400&q=80"
                            alt="Equipa Frasmart" class="w-full h-64 md:h-80 object-cover">
                    </div>

                    <div class="space-y-4 text-sm md:text-base text-gray-600 leading-relaxed">
                        <p>
                            Na <strong>Frasmart</strong>, acreditamos que o nosso sucesso é construído pelas pessoas que fazem parte da nossa equipa. Procuramos profissionais comprometidos, dinâmicos e apaixonados pelo atendimento ao cliente, que queiram crescer connosco e contribuir para proporcionar uma experiência de compra de excelência.
                        </p>
                        <p>
                            Independentemente da função que desempenha, cada colaborador desempenha um papel fundamental na construção da confiança que os nossos clientes depositam diariamente na Frasmart. É por isso que investimos no desenvolvimento das nossas pessoas, promovendo um ambiente de trabalho baseado no respeito, na colaboração e na valorização do talento.
                        </p>
                    </div>
                </div>

                <!-- Section 2: Porque trabalhar na Frasmart? -->
                <div class="space-y-4 pt-4 border-t border-gray-100">
                    <h3 class="text-xl font-extrabold text-gray-900 uppercase">Porque trabalhar na Frasmart?</h3>
                    <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                        Na Frasmart encontrará mais do que um emprego. Encontrará oportunidades para aprender, evoluir e construir uma carreira sólida numa empresa que acredita nas pessoas como o seu maior ativo. Valorizamos o empenho, reconhecemos o mérito e incentivamos o crescimento profissional através da formação contínua e da promoção interna, proporcionando condições para que cada colaborador possa desenvolver todo o seu potencial.
                    </p>
                </div>

                <!-- Section 3: O Que Oferecemos (5 Offer Cards) -->
                <div class="space-y-6 pt-4 border-t border-gray-100">
                    <div class="border-b border-gray-100 pb-4">
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 uppercase">O Que Oferecemos</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-gray-50/80 border border-gray-100 p-6 space-y-2">
                            <h4 class="font-extrabold text-gray-900 text-base uppercase border-b border-gray-200 pb-2">Crescimento Profissional</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Criamos oportunidades para que cada colaborador desenvolva novas competências e possa evoluir dentro da empresa, assumindo novos desafios e responsabilidades.
                            </p>
                        </div>

                        <div class="bg-gray-50/80 border border-gray-100 p-6 space-y-2">
                            <h4 class="font-extrabold text-gray-900 text-base uppercase border-b border-gray-200 pb-2">Formação Contínua</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Investimos na capacitação das nossas equipas através de programas de formação que reforçam conhecimentos técnicos, atendimento ao cliente e desenvolvimento pessoal.
                            </p>
                        </div>

                        <div class="bg-gray-50/80 border border-gray-100 p-6 space-y-2">
                            <h4 class="font-extrabold text-gray-900 text-base uppercase border-b border-gray-200 pb-2">Ambiente de Trabalho</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Promovemos um ambiente colaborativo, inclusivo e respeitador, onde o trabalho em equipa, a confiança e o espírito de entreajuda fazem parte da nossa cultura.
                            </p>
                        </div>

                        <div class="bg-gray-50/80 border border-gray-100 p-6 space-y-2">
                            <h4 class="font-extrabold text-gray-900 text-base uppercase border-b border-gray-200 pb-2">Reconhecimento</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Valorizamos o desempenho e o compromisso dos nossos colaboradores, reconhecendo diariamente a dedicação de quem contribui para o crescimento da Frasmart.
                            </p>
                        </div>

                        <div class="bg-gray-50/80 border border-gray-100 p-6 space-y-2 md:col-span-2 lg:col-span-1">
                            <h4 class="font-extrabold text-gray-900 text-base uppercase border-b border-gray-200 pb-2">Pessoas em Primeiro Lugar</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Acreditamos que colaboradores motivados proporcionam um melhor serviço aos nossos clientes. Por isso, procuramos criar um ambiente onde cada pessoa se sinta respeitada, ouvida e valorizada.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Section 4: A Nossa Cultura & Quem Procuramos -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4 border-t border-gray-100">
                    <div class="bg-gray-50/50 p-6 border border-gray-100 space-y-3">
                        <h3 class="text-xl font-extrabold text-gray-900 uppercase">A Nossa Cultura</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Na Frasmart acreditamos que o respeito, a integridade, a responsabilidade e o compromisso são valores essenciais para construir relações duradouras com colaboradores, clientes e parceiros. Procuramos criar um ambiente onde cada pessoa tenha oportunidade de crescer, contribuir com as suas ideias e sentir orgulho em fazer parte da nossa história.
                        </p>
                    </div>

                    <div class="bg-gray-50/50 p-6 border border-gray-100 space-y-3">
                        <h3 class="text-xl font-extrabold text-gray-900 uppercase">Quem Procuramos</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Estamos à procura de pessoas que partilhem os nossos valores e que queiram fazer parte de uma equipa dinâmica, orientada para o cliente e focada na excelência. Se é uma pessoa proativa, responsável, gosta de trabalhar em equipa e procura novos desafios, queremos conhecê-lo.
                        </p>
                    </div>
                </div>

                <!-- Section 5: Envie a sua Candidatura Form -->
                <div class="space-y-6 pt-4 border-t border-gray-100">
                    <div class="border-b border-gray-100 pb-4">
                        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 uppercase">Envie a sua Candidatura</h2>
                        <p class="text-sm text-gray-600 mt-1">
                            Acredita que pode fazer a diferença na Frasmart? Envie a sua candidatura e descubra as oportunidades disponíveis para construir uma carreira connosco. Estamos sempre à procura de novos talentos para integrar uma equipa que cresce todos os dias.
                        </p>
                    </div>

                    <!-- Success Alert -->
                    <div id="vacancy-page-success-alert"
                        class="hidden bg-green-50 border border-green-200 text-green-800 p-4 text-sm font-semibold">
                        <div>
                            Candidatura submetida com sucesso! Entraremos em contacto caso o seu perfil corresponda às nossas necessidades.
                        </div>
                    </div>

                    <!-- Error Alert -->
                    <div id="vacancy-page-error-alert"
                        class="hidden bg-red-50 border border-red-200 text-red-800 p-4 text-sm font-semibold">
                        Ocorreu um erro ao submeter a candidatura. Verifique os dados inseridos e tente novamente.
                    </div>

                    <!-- Application Form -->
                    <form id="vacancy-page-form" onsubmit="handleCareerFormSubmit(event)"
                        class="space-y-6 max-w-4xl bg-gray-50/50 p-6 md:p-8 border border-gray-100">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nome Completo *</label>
                                <input type="text" name="name" required placeholder="Seu nome completo"
                                    class="w-full border border-gray-200 rounded-xl text-sm px-4 py-3 focus:border-green-500 focus:ring focus:ring-green-100 focus:outline-none transition-colors bg-white">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">E-mail *</label>
                                <input type="email" name="email" required placeholder="seuemail@exemplo.com"
                                    class="w-full border border-gray-200 rounded-xl text-sm px-4 py-3 focus:border-green-500 focus:ring focus:ring-green-100 focus:outline-none transition-colors bg-white">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Telefone *</label>
                                <input type="text" name="phone" required placeholder="+244..."
                                    class="w-full border border-gray-200 rounded-xl text-sm px-4 py-3 focus:border-green-500 focus:ring focus:ring-green-100 focus:outline-none transition-colors bg-white">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Vaga / Função Desejada *</label>
                                <select name="position" required
                                    class="w-full border border-gray-200 rounded-xl text-sm px-4 py-3 focus:border-green-500 focus:outline-none transition-colors bg-white">
                                    <option value="">Selecione uma função</option>
                                    <option value="Operador de Loja / Caixa">Operador de Loja / Caixa</option>
                                    <option value="Técnico de Talho">Técnico de Talho</option>
                                    <option value="Colaborador de Padaria / Pasteleiro">Colaborador de Padaria / Pasteleiro</option>
                                    <option value="Ajudante de Armazém">Ajudante de Armazém</option>
                                    <option value="Candidatura Geral / Outra Posição">Candidatura Geral / Outra Posição</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Carregar Currículo (PDF, DOC, DOCX) *</label>
                            <input type="file" name="cv" accept=".pdf,.doc,.docx" required
                                class="w-full text-xs text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-100 file:text-green-800 hover:file:bg-green-200 cursor-pointer bg-white border border-gray-200 rounded-xl">
                            <p class="text-[11px] text-gray-400 mt-1">Tamanho máximo aceite: 5MB.</p>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Carta de Apresentação / Mensagem (opcional)</label>
                            <textarea name="cover_letter" rows="4" placeholder="Fale um pouco sobre si ou experiências anteriores..."
                                class="w-full border border-gray-200 rounded-xl text-sm px-4 py-3 focus:border-green-500 focus:ring focus:ring-green-100 focus:outline-none transition-colors bg-white"></textarea>
                        </div>

                        <div class="pt-2 flex justify-end">
                            <button type="submit" id="btn-submit-careers"
                                class="bg-[#45B500] hover:bg-[#3a9900] text-white font-bold py-3.5 px-8 rounded-2xl transition-all duration-300 shadow-md flex items-center gap-2 cursor-pointer">
                                <span>Enviar Candidatura Geral</span>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <x-slot:scripts>
        <script>
            function handleCareerFormSubmit(event) {
                event.preventDefault();
                var form = document.getElementById('vacancy-page-form');
                var submitBtn = document.getElementById('btn-submit-careers');
                var successAlert = document.getElementById('vacancy-page-success-alert');
                var errorAlert = document.getElementById('vacancy-page-error-alert');

                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span>A enviar...</span>';
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
                        submitBtn.innerHTML = '<span>Enviar Candidatura Geral</span>';
                        if (data.success) {
                            successAlert.classList.remove('hidden');
                            form.reset();
                        } else {
                            errorAlert.classList.remove('hidden');
                        }
                    })
                    .catch(function(err) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<span>Enviar Candidatura Geral</span>';
                        errorAlert.classList.remove('hidden');
                        console.error("Submission error: ", err);
                    });
            }
        </script>
    </x-slot:scripts>
</x-frontend.layout>
