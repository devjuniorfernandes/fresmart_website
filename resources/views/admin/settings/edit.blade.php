<x-admin-layout>
    <x-slot:header>Redes Sociais, Logo & Descrição CMS</x-slot>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl">
        @csrf
        @method('PUT')

        <div class="bg-white border border-gray-155 shadow-sm rounded-2xl overflow-hidden">
            <div class="border-b border-gray-155 px-6 py-4 bg-gray-50/50 font-bold text-slate-800 text-sm flex items-center gap-2">
                <i class="fas fa-cog text-[#45B500]"></i> Configurações Globais da Marca e Links
            </div>
            
            <div class="p-6 space-y-5">
                <p class="text-xs text-gray-500 pb-2">Gerencie a identidade visual da Fresmart (logótipo), a mensagem institucional exibida no rodapé, redes sociais e links de download das aplicações móveis.</p>
                
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

            <div class="bg-gray-50/50 p-4 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2.5 px-6 rounded-xl shadow-sm transition-all duration-200 text-sm">
                    Salvar Alterações
                </button>
            </div>
        </div>

        <!-- Banners das Páginas Públicas -->
        <div class="bg-white border border-gray-155 shadow-sm rounded-2xl overflow-hidden mt-8">
            <div class="border-b border-gray-155 px-6 py-4 bg-gray-50/50 font-bold text-slate-800 text-sm flex items-center gap-2">
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
                        <div class="font-bold text-slate-800 text-xs uppercase tracking-wide border-b border-gray-50 pb-2 flex justify-between items-center">
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
            
            <div class="bg-gray-50/50 p-4 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2.5 px-6 rounded-xl shadow-sm transition-all duration-200 text-sm">
                    Salvar Alterações
                </button>
            </div>
        </div>
    </form>
</x-admin-layout>
