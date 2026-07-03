<x-frontend.layout>
    <x-frontend.page-header 
        title="{{ $settings->banner_contacts_title ?: 'Fale Connosco' }}" 
        subtitle="{{ $settings->banner_contacts_subtitle ?: 'Estamos aqui para ajudar' }}"
        image="{{ $settings->banner_contacts_image ? asset($settings->banner_contacts_image) : asset('assets/img/hero.png') }}" />

    <section class="py-20 w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[1528px] mx-auto min-h-[50vh]">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Left: Contact Info -->
            <div class="bg-gray-50 rounded-2xl p-8 md:p-12 border border-gray-100 h-full">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Informações de Contacto</h2>
                
                <div class="space-y-8">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm text-[#45B500] text-xl flex-shrink-0">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-lg mb-1">E-mail</h4>
                            <p class="text-gray-600">{{ $settings->contact_email ?: 'geral@fresmart.ao' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm text-[#45B500] text-xl flex-shrink-0">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-lg mb-1">Telefone</h4>
                            <p class="text-gray-600">{{ $settings->contact_phone ?: '+244 923 000 000' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm text-[#45B500] text-xl flex-shrink-0">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-lg mb-1">Sede</h4>
                            <p class="text-gray-600">{{ $settings->contact_address ?: 'Luanda, Angola' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right: Contact Form -->
            <div class="bg-white rounded-2xl p-8 md:p-12 shadow-sm border border-gray-100">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Envie-nos uma Mensagem</h2>
                
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-lg">
                        <p class="font-bold">Sucesso!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg">
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
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nome Completo</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-3.5 rounded-xl border border-gray-300 shadow-sm focus:border-[#45B500] focus:ring-[#45B500] transition-colors focus:outline-none" required>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-2">E-mail</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-3.5 rounded-xl border border-gray-300 shadow-sm focus:border-[#45B500] focus:ring-[#45B500] transition-colors focus:outline-none" required>
                    </div>
                    
                    <div>
                        <label for="subject" class="block text-sm font-bold text-gray-700 mb-2">Assunto</label>
                        <input type="text" id="subject" name="subject" class="w-full px-4 py-3.5 rounded-xl border border-gray-300 shadow-sm focus:border-[#45B500] focus:ring-[#45B500] transition-colors focus:outline-none" required>
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-bold text-gray-700 mb-2">Mensagem</label>
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
