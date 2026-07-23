<x-admin-layout>
    <x-slot:header>Configurações Globais do Website</x-slot>

    <!-- Tab Navigation Buttons -->
    <div class="flex border border-gray-200 mb-6 bg-white p-2 rounded-2xl shadow-sm gap-2 max-w-4xl">
        <button type="button" onclick="switchTab('tab-brand')" id="btn-tab-brand" 
                class="tab-btn flex-1 py-3 px-4 rounded-xl text-xs font-bold uppercase tracking-wider text-center transition-all duration-200 bg-[#45B500] text-white shadow-sm">
            <i class="fas fa-id-card mr-2"></i> Identidade e Contactos
        </button>
        <button type="button" onclick="switchTab('tab-social')" id="btn-tab-social" 
                class="tab-btn flex-1 py-3 px-4 rounded-xl text-xs font-bold uppercase tracking-wider text-center transition-all duration-200 bg-gray-50 text-slate-600 hover:bg-gray-100">
            <i class="fas fa-share-nodes mr-2"></i> Redes Sociais e Apps
        </button>
        <button type="button" onclick="switchTab('tab-banners')" id="btn-tab-banners" 
                class="tab-btn flex-1 py-3 px-4 rounded-xl text-xs font-bold uppercase tracking-wider text-center transition-all duration-200 bg-gray-50 text-slate-600 hover:bg-gray-100">
            <i class="fas fa-images mr-2"></i> Banners das Páginas
        </button>
    </div>

    @if(session('success'))
        <div class="mb-6 max-w-4xl p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-xl shadow-sm text-sm">
            <p class="font-bold">Sucesso!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl space-y-6">
        @csrf
        @method('PUT')

        <!-- TAB 1: IDENTIDADE E CONTACTOS -->
        <div id="tab-brand" class="tab-content space-y-6">
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden">
                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-bold text-slate-800 text-sm flex items-center gap-2">
                    <i class="fas fa-id-card text-[#45B500]"></i> Identidade da Marca e Informações de Contacto
                </div>
                
                <div class="p-6 space-y-5">
                    <p class="text-xs text-gray-500 pb-2">Gerencie o logótipo oficial, descrição institucional exibida no rodapé e informações de contacto direto exibidas ao público.</p>
                    
                    <!-- Logo Upload -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5 flex items-center gap-2">
                            <i class="fas fa-image text-slate-600 text-sm w-4"></i> Logótipo Oficial (Branco/Transparente preferido)
                        </label>
                        @if($setting->logo)
                            <div class="mb-3 p-3 bg-[#45B500] rounded-xl inline-block shadow-sm">
                                <img src="{{ asset($setting->logo) }}" class="h-10 w-auto object-contain" alt="Logo atual">
                            </div>
                        @endif
                        <input type="file" name="logo" accept="image/*" 
                               class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-[#45B500] hover:file:bg-green-100 cursor-pointer">
                        @error('logo') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5 flex items-center gap-2">
                            <i class="fas fa-comment-alt text-slate-600 text-sm w-4"></i> Descrição do Rodapé
                        </label>
                        <textarea name="description" rows="3" placeholder="Servindo Angola com coração. Qualidade, frescura e os melhores preços perto de si."
                                  class="w-full border-gray-300 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:ring-opacity-50 transition-colors">{{ old('description', $setting->description) }}</textarea>
                        @error('description') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <hr class="border-gray-100 my-6">

                    <!-- Informações de Contacto -->
                    <div class="space-y-4">
                        <h3 class="font-bold text-slate-800 text-xs uppercase tracking-wide">Informações de Contacto Públicas</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5 flex items-center gap-2">
                                    <i class="fas fa-envelope text-slate-600 text-sm w-4"></i> E-mail de Contacto
                                </label>
                                <input type="email" name="contact_email" value="{{ old('contact_email', $setting->contact_email) }}" 
                                       placeholder="geral@fresmart.ao"
                                       class="w-full border-gray-300 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:ring-opacity-50 transition-colors">
                                @error('contact_email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5 flex items-center gap-2">
                                    <i class="fas fa-phone-alt text-slate-600 text-sm w-4"></i> Telefone
                                </label>
                                <input type="text" name="contact_phone" value="{{ old('contact_phone', $setting->contact_phone) }}" 
                                       placeholder="+244 923 000 000"
                                       class="w-full border-gray-300 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:ring-opacity-50 transition-colors">
                                @error('contact_phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5 flex items-center gap-2">
                                    <i class="fas fa-headset text-slate-600 text-sm w-4"></i> Linha de Apoio
                                </label>
                                <input type="text" name="support_phone" value="{{ old('support_phone', $setting->support_phone) }}" 
                                       placeholder="+244 923 000 000"
                                       class="w-full border-gray-300 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:ring-opacity-50 transition-colors">
                                @error('support_phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5 flex items-center gap-2">
                                <i class="fas fa-map-marker-alt text-slate-600 text-sm w-4"></i> Sede / Endereço
                            </label>
                            <input type="text" name="contact_address" value="{{ old('contact_address', $setting->contact_address) }}" 
                                   placeholder="Luanda, Angola"
                                   class="w-full border-gray-300 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:ring-opacity-50 transition-colors">
                            @error('contact_address') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 2: REDES SOCIAIS E APPS -->
        <div id="tab-social" class="tab-content space-y-6 hidden">
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden">
                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-bold text-slate-800 text-sm flex items-center gap-2">
                    <i class="fas fa-share-nodes text-[#45B500]"></i> Links de Redes Sociais e Lojas Móveis
                </div>
                
                <div class="p-6 space-y-5">
                    <p class="text-xs text-gray-500 pb-2">Preencha as URLs oficiais das contas sociais da marca e os links de download das aplicações móveis nas respetivas lojas.</p>
                    
                    <!-- Facebook -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5 flex items-center gap-2">
                            <i class="fab fa-facebook text-blue-600 text-sm w-4"></i> Facebook Link
                        </label>
                        <input type="url" name="facebook" value="{{ old('facebook', $setting->facebook) }}" 
                               placeholder="https://facebook.com/fresmart"
                               class="w-full border-gray-300 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:ring-opacity-50 transition-colors">
                        @error('facebook') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Instagram -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5 flex items-center gap-2">
                            <i class="fab fa-instagram text-pink-600 text-sm w-4"></i> Instagram Link
                        </label>
                        <input type="url" name="instagram" value="{{ old('instagram', $setting->instagram) }}" 
                               placeholder="https://instagram.com/fresmart"
                               class="w-full border-gray-300 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:ring-opacity-50 transition-colors">
                        @error('instagram') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- TikTok -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5 flex items-center gap-2">
                            <i class="fab fa-tiktok text-black text-sm w-4"></i> TikTok Link
                        </label>
                        <input type="url" name="tiktok" value="{{ old('tiktok', $setting->tiktok) }}" 
                               placeholder="https://tiktok.com/@fresmart"
                               class="w-full border-gray-300 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:ring-opacity-50 transition-colors">
                        @error('tiktok') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- LinkedIn -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5 flex items-center gap-2">
                            <i class="fab fa-linkedin text-blue-700 text-sm w-4"></i> LinkedIn Link
                        </label>
                        <input type="url" name="linkedin" value="{{ old('linkedin', $setting->linkedin) }}" 
                               placeholder="https://linkedin.com/company/fresmart"
                               class="w-full border-gray-300 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:ring-opacity-50 transition-colors">
                        @error('linkedin') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- YouTube -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5 flex items-center gap-2">
                            <i class="fab fa-youtube text-red-600 text-sm w-4"></i> YouTube Link
                        </label>
                        <input type="url" name="youtube" value="{{ old('youtube', $setting->youtube) }}" 
                               placeholder="https://youtube.com/@fresmart"
                               class="w-full border-gray-300 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:ring-opacity-50 transition-colors">
                        @error('youtube') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- WhatsApp -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5 flex items-center gap-2">
                            <i class="fab fa-whatsapp text-green-600 text-sm w-4"></i> WhatsApp Apoio Link ou Número
                        </label>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp', $setting->whatsapp) }}" 
                               placeholder="Ex: +244923000000 ou https://wa.me/244923000000"
                               class="w-full border-gray-300 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:ring-opacity-50 transition-colors">
                        @error('whatsapp') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <hr class="border-gray-100 my-6">

                    <!-- App Store -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5 flex items-center gap-2">
                            <i class="fab fa-apple text-gray-800 text-sm w-4"></i> App Store URL (Apple)
                        </label>
                        <input type="url" name="app_store" value="{{ old('app_store', $setting->app_store) }}" 
                               placeholder="https://apps.apple.com/..."
                               class="w-full border-gray-300 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:ring-opacity-50 transition-colors">
                        @error('app_store') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Google Play -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5 flex items-center gap-2">
                            <i class="fab fa-android text-green-600 text-sm w-4"></i> Google Play URL (Android)
                        </label>
                        <input type="url" name="google_play" value="{{ old('google_play', $setting->google_play) }}" 
                               placeholder="https://play.google.com/store/..."
                               class="w-full border-gray-300 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:ring-opacity-50 transition-colors">
                        @error('google_play') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 3: BANNERS DAS PÁGINAS -->
        <div id="tab-banners" class="tab-content space-y-6 hidden">
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden">
                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-bold text-slate-800 text-sm flex items-center gap-2">
                    <i class="fas fa-image text-[#45B500]"></i> Banners das Páginas Públicas (Cabeçalhos)
                </div>
                
                <div class="p-6 space-y-6">
                    <p class="text-xs text-gray-500 pb-2">Gerencie as imagens de fundo, títulos e subtítulos de cabeçalho exibidos nas páginas públicas do site.</p>
                    
                    @php
                        $bannerSections = [
                            'products' => 'Produtos (Departamentos)',
                            'services' => 'Serviços',
                            'campaigns' => 'Ofertas Especiais',
                            'stores' => 'Nossas Lojas',
                            'contacts' => 'Fale Connosco (Contactos)',
                            'recipes' => 'Receitas'
                        ];
                    @endphp

                    @foreach($bannerSections as $key => $label)
                        <div class="border border-gray-100 rounded-xl p-4 space-y-4 bg-gray-50/20">
                            <div class="font-bold text-slate-800 text-xs uppercase tracking-wide border-b border-gray-100/50 pb-2 flex justify-between items-center">
                                <span>Banner - Secção {{ $label }}</span>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1">Título do Banner</label>
                                    <input type="text" name="banner_{{ $key }}_title" value="{{ old('banner_' . $key . '_title', $setting->{'banner_' . $key . '_title'}) }}"
                                           placeholder="Ex: Nossos {{ $label }}"
                                           class="w-full border-gray-300 rounded-xl text-xs px-3 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:ring-opacity-50 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1">Subtítulo do Banner</label>
                                    <input type="text" name="banner_{{ $key }}_subtitle" value="{{ old('banner_' . $key . '_subtitle', $setting->{'banner_' . $key . '_subtitle'}) }}"
                                           placeholder="Ex: Conheça as nossas novidades"
                                           class="w-full border-gray-300 rounded-xl text-xs px-3 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 focus:ring-opacity-50 transition-colors">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1.5">Imagem de Fundo do Banner</label>
                                @if($setting->{"banner_{$key}_image"})
                                    <div class="mb-3 rounded-xl overflow-hidden border border-gray-100 h-24 max-w-md relative bg-gray-50">
                                        <img src="{{ asset($setting->{"banner_{$key}_image"}) }}" class="w-full h-full object-cover" alt="Banner atual">
                                    </div>
                                @endif
                                <input type="file" name="banner_{{ $key }}_image" accept="image/*" 
                                       class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-[#45B500] hover:file:bg-green-100 cursor-pointer">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Global Save Button (visible across all tabs) -->
        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-4 flex justify-end">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-8 rounded-xl shadow-sm transition-all duration-200 text-sm flex items-center gap-2">
                <i class="fas fa-save text-base"></i> Salvar Todas as Alterações
            </button>
        </div>
    </form>

    <script>
        function switchTab(tabId) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(function(el) {
                el.classList.add('hidden');
            });
            
            // Show selected tab content
            document.getElementById(tabId).classList.remove('hidden');
            
            // Reset all button styles to inactive
            document.querySelectorAll('.tab-btn').forEach(function(btn) {
                btn.classList.remove('bg-[#45B500]', 'text-white', 'shadow-sm');
                btn.classList.add('bg-gray-50', 'text-slate-600', 'hover:bg-gray-100');
            });
            
            // Set active button styles
            var activeBtn = document.getElementById('btn-' + tabId);
            activeBtn.classList.remove('bg-gray-50', 'text-slate-600', 'hover:bg-gray-100');
            activeBtn.classList.add('bg-[#45B500]', 'text-white', 'shadow-sm');
        }
    </script>
</x-admin-layout>
