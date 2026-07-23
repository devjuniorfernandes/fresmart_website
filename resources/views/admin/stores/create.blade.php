<x-admin-layout>
    <x-slot:header>
        Adicionar Nova Loja
    </x-slot>

    <form action="{{ route('admin.stores.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-6">
        @csrf
        
        <!-- Main Form Area -->
        <div class="flex-1 space-y-4">
            <div>
                <input type="text" name="name" id="name" required placeholder="Nome da Loja" 
                       class="w-full border-gray-300 rounded-xl text-lg px-4 py-3 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors shadow-sm" value="{{ old('name') }}">
                <input type="text" name="slug" placeholder="Slug (opcional - gerado automaticamente)" class="w-full border-gray-300 rounded-xl text-lg px-4 py-3 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors shadow-sm mt-2" value="{{ old('slug') }}">
            </div>

            <!-- Detalhes da Localização -->
            <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden">
                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-semibold text-slate-800 text-sm">
                    Detalhes da Localização
                </div>
                <div class="p-6 space-y-5">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Cidade *</label>
                            <input type="text" name="city" required class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors" value="{{ old('city') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Bairro *</label>
                            <input type="text" name="bairro" required class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors" value="{{ old('bairro') }}">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Endereço Completo *</label>
                        <textarea name="address" rows="2" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors" required>{{ old('address') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Latitude</label>
                            <input type="text" name="lat" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors" value="{{ old('lat') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Longitude</label>
                            <input type="text" name="lng" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors" value="{{ old('lng') }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Funcionamento e Contactos -->
            <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden">
                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-semibold text-slate-800 text-sm">
                    Funcionamento e Contactos
                </div>
                <div class="p-6 space-y-5">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Horário de Abertura</label>
                            <input type="time" name="opening_time" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors" value="{{ old('opening_time', '07:00') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Horário de Encerramento</label>
                            <input type="time" name="closing_time" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors" value="{{ old('closing_time', '22:00') }}">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Telefone</label>
                            <input type="text" name="phone" placeholder="+244..." class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors" value="{{ old('phone') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">WhatsApp Link/Número</label>
                            <input type="text" name="whatsapp" placeholder="+244..." class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors" value="{{ old('whatsapp') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">E-mail (opcional)</label>
                            <input type="email" name="email" placeholder="loja@fresmart.ao" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors" value="{{ old('email') }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Serviços e Comodidades -->
            <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden">
                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-semibold text-slate-800 text-sm">
                    Serviços e Comodidades Disponíveis
                </div>
                <div class="p-6">
                    @php
                        $availableServices = ['Talho', 'Café', 'Estacionamento', 'Take-away', 'Padaria', 'Charcutaria', 'Garrafeira', 'Peixaria'];
                    @endphp
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        @foreach($availableServices as $serviceName)
                            <label class="flex items-center space-x-2.5 text-sm text-gray-700 cursor-pointer select-none">
                                <input type="checkbox" name="services[]" value="{{ $serviceName }}" 
                                       class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                                <span>{{ $serviceName }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Actions (WordPress Style Publish Box) -->
        <div class="w-full lg:w-[280px] space-y-4">
            <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden">
                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-semibold text-slate-800 text-sm">
                    Publicar
                </div>
                <div class="p-3 space-y-3 text-[13px] text-[#50575e]">
                    <div class="flex items-center justify-between">
                        <span><i class="fas fa-map-pin mr-1"></i> Status:</span>
                        <select name="status" class="border-[#8c8f94] rounded-[3px] py-0.5 px-2 text-[13px]">
                            <option value="Aberta">Aberta</option>
                            <option value="Fechada">Fechada</option>
                            <option value="Em Breve">Em Breve</option>
                        </select>
                    </div>
                </div>
                <div class="bg-gray-50/50 border-t border-gray-100 p-4 flex justify-end">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-5 rounded-lg shadow-sm transition-all duration-200 shadow-sm">
                        Publicar
                    </button>
                </div>
            </div>

            <!-- Imagem de Capa -->
            <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden">
                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-semibold text-slate-800 text-sm">
                    Imagem de Capa
                </div>
                <div class="p-4 space-y-3">
                    <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" />
                    <p class="text-[11px] text-gray-500">Tamanho máximo de 2MB. Apenas imagens.</p>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
