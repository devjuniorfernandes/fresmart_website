<!-- Mobile Menu Overlay -->
<div id="mobile-menu" class="fixed inset-0 bg-white z-[100] flex flex-col transform translate-x-full transition-transform duration-300 md:hidden">
    <div class="flex justify-between items-center p-6 border-b border-gray-100 bg-[#45B500]">
        <a href="{{ url('/') }}">
            <img src="{{ asset('assets/img/logo-white.png') }}" alt="FRESMART" class="h-9 w-auto">
        </a>
        <button id="mobile-menu-close" class="text-white p-2 focus:outline-none">
            <i class="fas fa-times text-2xl"></i>
        </button>
    </div>
    <div class="flex-grow flex flex-col items-start justify-start space-y-2 p-6 overflow-y-auto pt-8">
        <a href="{{ url('/') }}" class="w-full text-xl font-bold text-[#45B500] py-3 border-b border-gray-100 mobile-link">Início</a>
        <a href="{{ url('/quem-somos') }}" class="w-full text-xl font-bold text-gray-800 hover:text-[#45B500] py-3 border-b border-gray-100 mobile-link">Quem Somos</a>
        <a href="{{ url('/ofertas') }}" class="w-full text-xl font-bold text-gray-800 hover:text-[#45B500] py-3 border-b border-gray-100 mobile-link">Ofertas</a>
        <a href="{{ url('/lojas') }}" class="w-full text-xl font-bold text-gray-800 hover:text-[#45B500] py-3 border-b border-gray-100 mobile-link">Lojas</a>
        <a href="{{ url('/servicos') }}" class="w-full text-xl font-bold text-gray-800 hover:text-[#45B500] py-3 border-b border-gray-100 mobile-link">Serviços</a>
        <a href="{{ url('/receitas') }}" class="w-full text-xl font-bold text-gray-800 hover:text-[#45B500] py-3 border-b border-gray-100 mobile-link">Receitas</a>
        
        @if($settings->app_store || $settings->google_play)
        <div class="pt-6 w-full">
            <a href="{{ $settings->app_store ?: $settings->google_play }}" target="_blank" 
               class="block w-full bg-[#45B500] text-white text-center font-bold py-4 rounded-xl shadow-lg hover:bg-[#3a9900] transition-colors">
                Baixar App
            </a>
        </div>
        @endif
    </div>
    <div class="p-6 border-t border-gray-100 flex justify-center gap-6 text-2xl text-gray-400">
        @if($settings->facebook)
            <a href="{{ $settings->facebook }}" target="_blank" class="hover:text-[#45B500] transition-colors"><i class="fab fa-facebook-f"></i></a>
        @endif
        @if($settings->instagram)
            <a href="{{ $settings->instagram }}" target="_blank" class="hover:text-[#45B500] transition-colors"><i class="fab fa-instagram"></i></a>
        @endif
        @if($settings->tiktok)
            <a href="{{ $settings->tiktok }}" target="_blank" class="hover:text-[#45B500] transition-colors"><i class="fab fa-tiktok"></i></a>
        @endif
        @if($settings->linkedin)
            <a href="{{ $settings->linkedin }}" target="_blank" class="hover:text-[#45B500] transition-colors"><i class="fab fa-linkedin-in"></i></a>
        @endif
        @if($settings->youtube)
            <a href="{{ $settings->youtube }}" target="_blank" class="hover:text-[#45B500] transition-colors"><i class="fab fa-youtube"></i></a>
        @endif
    </div>
</div>
