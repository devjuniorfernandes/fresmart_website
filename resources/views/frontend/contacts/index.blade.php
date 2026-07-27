<x-frontend.layout>
    <div class="bg-white border-b border-gray-100 py-6">
        <div class="max-w-[1528px] mx-auto px-6 lg:px-10">
            <x-frontend.breadcrumbs :items="[['label' => 'Quem Somos', 'url' => route('about.index')], ['label' => 'Contactos']]" />
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 uppercase mt-1">{{ $settings->banner_contacts_title ?: 'Contactos' }}</h1>
            <p class="text-sm text-gray-500 mt-1">{{ $settings->banner_contacts_subtitle ?: 'Estamos aqui para ajudar' }}</p>
        </div>
    </div>

    <section class="py-12 md:py-16 max-w-[1528px] mx-auto px-6 lg:px-10 min-h-[50vh]">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Left: Contact Info -->
            <div class="bg-gray-50 p-8 md:p-12 border border-gray-100 h-full">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 uppercase">Informações de Contacto</h2>
                
                <div class="space-y-8">
                    @if($settings->contact_email)
                        <div class="flex items-start gap-4">
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg mb-1">E-mail de Contacto</h4>
                                <p class="text-gray-600"><a href="mailto:{{ $settings->contact_email }}" class="hover:underline">{{ $settings->contact_email }}</a></p>
                            </div>
                        </div>
                    @endif

                    @if($settings->whatsapp)
                        <div class="flex items-start gap-4">
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg mb-1">WhatsApp Apoio</h4>
                                @php
                                    $waClean = preg_replace('/[^0-9]/', '', $settings->whatsapp);
                                    $waUrl = str_starts_with($settings->whatsapp, 'http') ? $settings->whatsapp : 'https://wa.me/' . $waClean;
                                @endphp
                                <p class="text-gray-600">
                                    <a href="{{ $waUrl }}" target="_blank" class="text-green-600 font-bold hover:underline">
                                        Conversar agora
                                    </a>
                                </p>
                            </div>
                        </div>
                    @endif

                    @if($settings->support_phone)
                        <div class="flex items-start gap-4">
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg mb-1">Linha de Apoio</h4>
                                <p class="text-gray-600"><a href="tel:{{ $settings->support_phone }}" class="hover:underline font-semibold">{{ $settings->support_phone }}</a></p>
                            </div>
                        </div>
                    @endif
                    
                    @if($settings->contact_phone)
                        <div class="flex items-start gap-4">
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg mb-1">Telefone Sede</h4>
                                <p class="text-gray-600"><a href="tel:{{ $settings->contact_phone }}" class="hover:underline font-semibold">{{ $settings->contact_phone }}</a></p>
                            </div>
                        </div>
                    @endif
                    
                    @if($settings->contact_address)
                        <div class="flex items-start gap-4">
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg mb-1">Sede</h4>
                                <p class="text-gray-600">{{ $settings->contact_address }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Right: Contact Form -->
            <div class="bg-white p-8 md:p-12 shadow-sm border border-gray-100">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 uppercase">Envie-nos uma Mensagem</h2>
                
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700">
                        <p class="font-bold">Sucesso!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                        <p class="font-bold">Erro de Validação</p>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
                
                <form action="{{ route('contacts.submit') }}" method="POST" class="space-y-6">
                     @csrf

                     <!-- Anti-bot Honeypot fields -->
                     <div class="hidden" aria-hidden="true">
                         <input type="text" name="website_url" id="website_url" autocomplete="off" tabindex="-1">
                         <input type="text" name="honeypot_field" id="honeypot_field" autocomplete="off" tabindex="-1">
                     </div>

                     <!-- Anti-bot Time check token -->
                     <input type="hidden" name="submission_time" value="{{ time() }}">

                     <div>
                         <label for="name" class="block text-sm font-bold text-gray-700 mb-2 uppercase">Nome Completo</label>
                         <input type="text" id="name" name="name" class="w-full px-4 py-3.5 rounded-xl border border-gray-300 shadow-sm focus:border-[#45B500] focus:ring-[#45B500] transition-colors focus:outline-none" required>
                     </div>
                     
                     <div>
                         <label for="email" class="block text-sm font-bold text-gray-700 mb-2 uppercase">E-mail</label>
                         <input type="email" id="email" name="email" class="w-full px-4 py-3.5 rounded-xl border border-gray-300 shadow-sm focus:border-[#45B500] focus:ring-[#45B500] transition-colors focus:outline-none" required>
                     </div>
                     
                     <div>
                         <label for="subject" class="block text-sm font-bold text-gray-700 mb-2 uppercase">Assunto</label>
                         <select id="subject" name="subject" class="w-full px-4 py-3.5 rounded-xl border border-gray-300 shadow-sm focus:border-[#45B500] focus:ring-[#45B500] bg-white transition-colors focus:outline-none" required>
                             <option value="">Selecione o assunto...</option>
                             <option value="Apoio ao Cliente">Apoio ao Cliente</option>
                             <option value="Sugestão / Reclamação">Sugestão / Reclamação</option>
                             <option value="Parcerias Comerciais">Parcerias Comerciais</option>
                             <option value="Outro Assunto">Outro Assunto</option>
                         </select>
                     </div>
                     
                     <div>
                         <label for="message" class="block text-sm font-bold text-gray-700 mb-2 uppercase">Mensagem</label>
                         <textarea id="message" name="message" rows="5" class="w-full px-4 py-3.5 rounded-xl border border-gray-300 shadow-sm focus:border-[#45B500] focus:ring-[#45B500] transition-colors focus:outline-none" required></textarea>
                     </div>
                    
                    <button type="submit" class="w-full btn-primary bg-[#45B500] hover:bg-[#3a9900] text-white font-bold py-4 rounded-xl shadow-lg transition-all duration-300">
                        Enviar Mensagem
                    </button>
                </form>
            </div>
        </div>
    </section>
</x-frontend.layout>
