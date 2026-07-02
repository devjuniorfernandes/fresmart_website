<x-admin-layout>
    <x-slot:header>Redes Sociais & Links Globais</x-slot>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="max-w-4xl">
        @csrf
        @method('PUT')

        <div class="bg-white border border-gray-150 shadow-sm rounded-2xl overflow-hidden">
            <div class="border-b border-gray-155 px-6 py-4 bg-gray-50/50 font-bold text-slate-800 text-sm flex items-center gap-2">
                <i class="fas fa-share-alt text-[#45B500]"></i> Configuração de Redes Sociais e Apps
            </div>
            
            <div class="p-6 space-y-5">
                <p class="text-xs text-gray-500 pb-2">Insira os endereços completos (URLs) para os canais de redes sociais da Fresmart e links das aplicações móveis. Deixe em branco para desativar a exibição.</p>
                
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
    </form>
</x-admin-layout>
