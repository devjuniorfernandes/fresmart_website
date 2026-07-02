<footer class="bg-[#45B500] pt-7 text-white">
    <!-- Main footer columns -->
    <div
        class="w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[1528px] mx-auto grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-10 mb-16">

        <!-- Coluna 1: Fale Connosco -->
        <div class="col-span-2 lg:col-span-1 space-y-5">
            <img src="{{ asset('assets/img/logo-white.png') }}" alt="FRESMART" class="h-20 w-auto">
            <p class="text-sm text-white/80 leading-relaxed">Servindo Angola com coração. Qualidade, frescura e os
                melhores preços perto de si.</p>
            <div class="flex space-x-3 pt-1">
                @if($settings->facebook)
                    <a href="{{ $settings->facebook }}" target="_blank"
                        class="w-9 h-9 rounded-full bg-white/20 hover:bg-white/40 flex items-center justify-center transition-colors"><i
                            class="fab fa-facebook-f text-sm"></i></a>
                @endif
                @if($settings->youtube)
                    <a href="{{ $settings->youtube }}" target="_blank"
                        class="w-9 h-9 rounded-full bg-white/20 hover:bg-white/40 flex items-center justify-center transition-colors"><i
                            class="fab fa-youtube text-sm"></i></a>
                @endif
                @if($settings->instagram)
                    <a href="{{ $settings->instagram }}" target="_blank"
                        class="w-9 h-9 rounded-full bg-white/20 hover:bg-white/40 flex items-center justify-center transition-colors"><i
                            class="fab fa-instagram text-sm"></i></a>
                @endif
                @if($settings->tiktok)
                    <a href="{{ $settings->tiktok }}" target="_blank"
                        class="w-9 h-9 rounded-full bg-white/20 hover:bg-white/40 flex items-center justify-center transition-colors"><i
                            class="fab fa-tiktok text-sm"></i></a>
                @endif
                @if($settings->linkedin)
                    <a href="{{ $settings->linkedin }}" target="_blank"
                        class="w-9 h-9 rounded-full bg-white/20 hover:bg-white/40 flex items-center justify-center transition-colors"><i
                            class="fab fa-linkedin-in text-sm"></i></a>
                @endif
            </div>
            <div class="flex flex-row space-x-3 items-center pt-2">
                @if($settings->app_store)
                    <a href="{{ $settings->app_store }}" target="_blank" class="hover:scale-105 transition-transform duration-300">
                        <img src="{{ asset('assets/img/appstore.png') }}" alt="App Store" class="h-9 w-auto">
                    </a>
                @endif
                @if($settings->google_play)
                    <a href="{{ $settings->google_play }}" target="_blank" class="hover:scale-105 transition-transform duration-300">
                        <img src="{{ asset('assets/img/googleplay.png') }}" alt="Google Play" class="h-9 w-auto">
                    </a>
                @endif
            </div>
        </div>

        <!-- Coluna 2: Descubra Mais -->
        <div>
            <h3 class="font-bold text-base mb-4 border-b border-white/20 pb-3">Descubra Mais</h3>
            <ul class="space-y-3 text-sm text-white/90">
                <li><a href="{{ url('/ofertas') }}" class="hover:text-white hover:underline transition">Ofertas da
                        Semana</a></li>
                <li><a href="{{ url('/receitas') }}" class="hover:text-white hover:underline transition">Receitas</a>
                </li>
                <li><a href="{{ url('/servicos#fresonline') }}"
                        class="hover:text-white hover:underline transition">Fresonline</a></li>
                <li><a href="{{ url('/servicos#frescafe') }}"
                        class="hover:text-white hover:underline transition">Frescafé</a></li>
                <li><a href="{{ url('/servicos#freshoreca') }}" class="hover:text-white hover:underline transition">Fres
                        Horeca</a></li>
                <li><a href="{{ url('/lojas') }}" class="hover:text-white hover:underline transition">Encontre uma
                        Loja</a></li>
            </ul>
        </div>

        <!-- Coluna 3: Links Rápidos -->
        <div>
            <h3 class="font-bold text-base mb-4 border-b border-white/20 pb-3">Links Rápidos</h3>
            <ul class="space-y-3 text-sm text-white/90">
                <li><a href="#" class="hover:text-white hover:underline transition">Ajuda</a></li>
                <li><a href="#" class="hover:text-white hover:underline transition">Folhetos</a></li>
                <li><a href="{{ url('/receitas') }}" class="hover:text-white hover:underline transition">Receitas</a>
                </li>
                <li><a href="#" class="hover:text-white hover:underline transition">Sustentabilidade</a></li>
                <li><a href="{{ url('/lojas') }}" class="hover:text-white hover:underline transition">Lojas</a></li>
                <li><a href="#" class="hover:text-white hover:underline transition">Cartão Fresmart</a></li>
                <li><a href="#" class="hover:text-white hover:underline transition">Mapa do Site</a></li>
            </ul>
        </div>

        <!-- Coluna 4: Sobre Nós -->
        <div>
            <h3 class="font-bold text-base mb-4 border-b border-white/20 pb-3">Sobre Nós</h3>
            <ul class="space-y-3 text-sm text-white/90">
                <li><a href="{{ url('/quem-somos') }}" class="hover:text-white hover:underline transition">Quem
                        Somos</a></li>
                <li><a href="{{ url('/servicos') }}" class="hover:text-white hover:underline transition">Nossos
                        serviços</a></li>
                <li><a href="#" class="hover:text-white hover:underline transition">Trabalhe Connosco</a></li>
                <li><a href="#" class="hover:text-white hover:underline transition">Responsabilidade Social</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Bottom Footer -->
    <div class="bg-black/40 py-6 border-t border-white/10">
        <div
            class="w-[calc(100%-2rem)] md:w-[calc(100%-3rem)] max-w-[1528px] mx-auto flex flex-col md:flex-row justify-between items-center text-xs text-white/60 gap-3">
            <div>&copy; {{ date('Y') }} Fresmart. Todos os direitos reservados.</div>
            <div class="flex flex-wrap justify-center gap-x-6 gap-y-2">
                <a href="#" class="hover:text-white transition-colors">Acessibilidade</a>
                <a href="#" class="hover:text-white transition-colors">Política de Serviços</a>
                <a href="#" class="hover:text-white transition-colors">Política de Cookies</a>
                <a href="#" class="hover:text-white transition-colors">Centro de Privacidade</a>
                <a href="#" class="hover:text-white transition-colors">Política de Privacidade</a>
            </div>
        </div>
    </div>
</footer>
