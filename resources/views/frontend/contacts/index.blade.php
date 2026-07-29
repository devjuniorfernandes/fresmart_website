<x-frontend.layout>
    <div class="bg-white border-b border-gray-100 py-6">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
            <x-frontend.breadcrumbs :items="[['label' => 'Quem Somos', 'url' => route('about.index')], ['label' => 'Contactos']]" />
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 uppercase mt-1">
                {{ $settings->banner_contacts_title ?: 'Contactos' }}</h1>
            <p class="text-sm text-gray-500 mt-1">{{ $settings->banner_contacts_subtitle ?: 'Estamos aqui para ajudar' }}
            </p>
        </div>
    </div>

    <section class="bg-white max-w-[1528px] mx-auto px-6 lg:px-10 py-12 min-h-[50vh] space-y-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Left: Contact Info (Unboxed & Clean) -->
            <div class="space-y-8">
                <div class="border-b border-gray-100 pb-4">
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 uppercase">Informações de Contacto</h2>
                    <p class="text-sm text-gray-500 mt-1">Utilize os canais abaixo para entrar em contacto direto com a
                        nossa equipa.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 pt-2">
                    @if ($settings->contact_email)
                        <div class="space-y-1">
                            <h4 class="font-bold text-gray-900 text-sm uppercase">E-mail de Contacto</h4>
                            <p class="text-sm text-gray-600">
                                <a href="mailto:{{ $settings->contact_email }}"
                                    class="hover:text-[#45B500] transition-colors">
                                    {{ $settings->contact_email }}
                                </a>
                            </p>
                        </div>
                    @endif

                    @if ($settings->contact_phone)
                        <div class="space-y-1">
                            <h4 class="font-bold text-gray-900 text-sm uppercase">Telefone</h4>
                            <p class="text-sm text-gray-600">
                                <a href="tel:{{ $settings->contact_phone }}"
                                    class="hover:text-[#45B500] transition-colors">
                                    {{ $settings->contact_phone }}
                                </a>
                            </p>
                        </div>
                    @endif

                    @if ($settings->support_phone)
                        <div class="space-y-1">
                            <h4 class="font-bold text-gray-900 text-sm uppercase">Linha de Apoio</h4>
                            <p class="text-sm text-gray-600">
                                <a href="tel:{{ $settings->support_phone }}"
                                    class="hover:text-[#45B500] transition-colors">
                                    {{ $settings->support_phone }}
                                </a>
                            </p>
                        </div>
                    @endif

                    @if ($settings->contact_address)
                        <div class="space-y-1">
                            <h4 class="font-bold text-gray-900 text-sm uppercase">Sede / Endereço</h4>
                            <p class="text-sm text-gray-600">
                                {{ $settings->contact_address }}
                            </p>
                        </div>
                    @endif

                    @if ($settings->whatsapp)
                        <div class="space-y-1 sm:col-span-2 pt-2 border-t border-gray-100">
                            <h4 class="font-bold text-gray-900 text-sm uppercase">WhatsApp Apoio</h4>
                            @php
                                $waClean = preg_replace('/[^0-9]/', '', $settings->whatsapp);
                                $waUrl = str_starts_with($settings->whatsapp, 'http')
                                    ? $settings->whatsapp
                                    : 'https://wa.me/' . $waClean;
                            @endphp
                            <p class="text-sm">
                                <a href="{{ $waUrl }}" target="_blank"
                                    class="inline-flex items-center gap-2 text-green-600 font-bold hover:underline">
                                    <i class="fa-brands fa-whatsapp text-lg"></i> Conversar agora no WhatsApp
                                </a>
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right: Contact Form -->
            <div class="bg-white p-8 md:p-10 border border-gray-100 space-y-6">
                <h2 class="text-2xl font-bold text-gray-900 uppercase">Envie-nos uma Mensagem</h2>

                @if (session('success'))
                    <div
                        class="p-4 bg-green-50 border border-green-200 text-green-800 rounded-2xl text-sm font-semibold">
                        <p class="font-bold">Sucesso!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="p-4 bg-red-50 border border-red-200 text-red-800 rounded-2xl text-sm font-semibold">
                        <p class="font-bold">Erro de Validação</p>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                <form action="{{ route('contacts.submit') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Anti-bot Honeypot fields -->
                    <div class="hidden" aria-hidden="true">
                        <input type="text" name="website_url" id="website_url" autocomplete="off" tabindex="-1">
                        <input type="text" name="honeypot_field" id="honeypot_field" autocomplete="off"
                            tabindex="-1">
                    </div>

                    <!-- Anti-bot Time check token -->
                    <input type="hidden" name="submission_time" value="{{ time() }}">

                    <div>
                        <label for="name" class="block text-xs font-bold text-gray-700 mb-1.5 uppercase">Nome
                            Completo</label>
                        <input type="text" id="name" name="name"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 shadow-sm focus:border-[#45B500] focus:ring focus:ring-green-100 transition-colors focus:outline-none text-sm bg-white"
                            required placeholder="Seu nome completo">
                    </div>

                    <div>
                        <label for="email"
                            class="block text-xs font-bold text-gray-700 mb-1.5 uppercase">E-mail</label>
                        <input type="email" id="email" name="email"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 shadow-sm focus:border-[#45B500] focus:ring focus:ring-green-100 transition-colors focus:outline-none text-sm bg-white"
                            required placeholder="seuemail@exemplo.com">
                    </div>

                    <div>
                        <label for="subject"
                            class="block text-xs font-bold text-gray-700 mb-1.5 uppercase">Assunto</label>
                        <select id="subject" name="subject"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 shadow-sm focus:border-[#45B500] focus:ring focus:ring-green-100 bg-white transition-colors focus:outline-none text-sm"
                            required>
                            <option value="">Selecione o assunto...</option>
                            <option value="Apoio ao Cliente">Apoio ao Cliente</option>
                            <option value="Sugestão / Reclamação">Sugestão / Reclamação</option>
                            <option value="Parcerias Comerciais">Parcerias Comerciais</option>
                            <option value="Outro Assunto">Outro Assunto</option>
                        </select>
                    </div>

                    <div>
                        <label for="message"
                            class="block text-xs font-bold text-gray-700 mb-1.5 uppercase">Mensagem</label>
                        <textarea id="message" name="message" rows="4"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 shadow-sm focus:border-[#45B500] focus:ring focus:ring-green-100 transition-colors focus:outline-none text-sm bg-white"
                            required placeholder="Escreva a sua mensagem..."></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#45B500] hover:bg-[#3a9900] text-white font-bold py-4 rounded-2xl shadow-md transition-all duration-300 uppercase tracking-wider text-sm cursor-pointer">
                        Enviar Mensagem
                    </button>
                </form>
            </div>
        </div>

        <!-- Google Maps Iframe Embed (CMS Managed) -->
        @if ($settings->contact_map_iframe)
            <div
                class="w-full overflow-hidden border border-gray-100 [&_iframe]:w-full [&_iframe]:h-[450px] [&_iframe]:border-0">
                {!! $settings->contact_map_iframe !!}
            </div>
        @endif
    </section>
</x-frontend.layout>
