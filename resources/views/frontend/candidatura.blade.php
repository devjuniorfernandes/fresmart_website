<x-frontend.layout>
    <!-- Header & Breadcrumbs -->
    <div class="bg-white border-b border-gray-100 py-6">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
            <x-frontend.breadcrumbs :items="[
                ['label' => 'Quem Somos', 'url' => route('about.index')],
                ['label' => 'Trabalhe Connosco', 'url' => route('careers.index')],
                ['label' => 'Formulário de Candidatura']
            ]" />
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 uppercase mt-1">Formulário de Candidatura</h1>
            <p class="text-sm text-gray-500 mt-1">Preencha os seus dados e envie o seu currículo para fazer parte da nossa equipa.</p>
        </div>
    </div>

    <section class="bg-white w-full min-h-[60vh] py-12">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
            
            <div class="max-w-3xl mx-auto space-y-8">

                <!-- Header Info Box -->
                <div class="space-y-2 border-b border-gray-100 pb-6">
                    <h2 class="text-2xl font-extrabold text-gray-900 uppercase">Junte-se à Fresmart</h2>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Procuramos talentos dedicados e com vontade de crescer. Preencha todos os campos obrigatórios (*) e anexe o seu CV atualizado. Entraremos em contacto assim que houver uma oportunidade adequada ao seu perfil.
                    </p>
                </div>

                <!-- Success Alert -->
                <div id="vacancy-page-success-alert"
                    class="hidden bg-green-50 border border-green-200 text-green-800 p-5 rounded-2xl text-sm font-semibold">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-check text-green-600 text-xl"></i>
                        <div>
                            Candidatura submetida com sucesso! Agradecemos o seu interesse em trabalhar na Fresmart.
                        </div>
                    </div>
                </div>

                <!-- Error Alert -->
                <div id="vacancy-page-error-alert"
                    class="hidden bg-red-50 border border-red-200 text-red-800 p-5 rounded-2xl text-sm font-semibold">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-triangle-exclamation text-red-600 text-xl"></i>
                        <div>
                            Ocorreu um erro ao submeter a candidatura. Verifique os dados inseridos e tente novamente.
                        </div>
                    </div>
                </div>

                <!-- Application Form -->
                <form id="vacancy-page-form" onsubmit="handleCareerFormSubmit(event)" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Nome Completo *</label>
                            <input type="text" name="name" required placeholder="Seu nome completo"
                                class="w-full border border-gray-200 rounded-xl text-sm px-4 py-3.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:outline-none transition-colors bg-white">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">E-mail *</label>
                            <input type="email" name="email" required placeholder="seuemail@exemplo.com"
                                class="w-full border border-gray-200 rounded-xl text-sm px-4 py-3.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:outline-none transition-colors bg-white">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Telefone *</label>
                            <input type="text" name="phone" required placeholder="+244..."
                                class="w-full border border-gray-200 rounded-xl text-sm px-4 py-3.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:outline-none transition-colors bg-white">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Vaga / Função Desejada *</label>
                            <select name="position" required
                                class="w-full border border-gray-200 rounded-xl text-sm px-4 py-3.5 focus:border-green-500 focus:outline-none transition-colors bg-white">
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
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Carregar Currículo (PDF, DOC, DOCX) *</label>
                        <input type="file" name="cv" accept=".pdf,.doc,.docx" required
                            class="w-full text-xs text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-100 file:text-green-800 hover:file:bg-green-200 cursor-pointer bg-white border border-gray-200 rounded-xl">
                        <p class="text-[11px] text-gray-400 mt-1.5">Tamanho máximo aceite: 5MB.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Carta de Apresentação / Mensagem (opcional)</label>
                        <textarea name="cover_letter" rows="5" placeholder="Fale um pouco sobre si ou experiências anteriores..."
                            class="w-full border border-gray-200 rounded-xl text-sm px-4 py-3.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:outline-none transition-colors bg-white"></textarea>
                    </div>

                    <div class="pt-4 flex items-center justify-between">
                        <a href="{{ route('careers.index') }}" class="text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors inline-flex items-center gap-2">
                            <i class="fa-solid fa-arrow-left"></i> Voltar a Trabalhe Connosco
                        </a>
                        <button type="submit" id="btn-submit-careers"
                            class="bg-[#45B500] hover:bg-[#3a9900] text-white font-bold py-4 px-10 rounded-2xl transition-all duration-300 shadow-md flex items-center gap-2 cursor-pointer">
                            <span>Submeter Candidatura</span>
                        </button>
                    </div>
                </form>

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
