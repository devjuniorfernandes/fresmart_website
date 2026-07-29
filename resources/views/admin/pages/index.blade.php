<x-admin-layout>
    <x-slot:header>Gerenciador de Páginas do Website</x-slot>

    @if (session('success'))
        <div class="mb-6 max-w-6xl p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-xl shadow-sm text-sm">
            <p class="font-bold">Sucesso!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden max-w-6xl">
        <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 flex items-center justify-between">
            <div>
                <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wide">Páginas Institucionais e Conteúdo</h3>
                <p class="text-xs text-gray-500 mt-0.5">Selecione uma página para editar os seus títulos, textos e imagens em tempo real.</p>
            </div>
        </div>

        <div class="divide-y divide-gray-100">
            @foreach($pages as $page)
                <div class="p-6 flex flex-col md:flex-row md:items-center justify-between gap-4 hover:bg-gray-50/60 transition-colors">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-green-50 text-[#45B500] flex items-center justify-center flex-shrink-0 text-xl font-bold border border-green-100 shadow-sm">
                            <i class="fas fa-file-lines"></i>
                        </div>
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <h4 class="font-bold text-slate-900 text-base">{{ $page->name }}</h4>
                                <span class="px-2.5 py-0.5 bg-gray-100 text-gray-600 text-[11px] font-bold rounded-full font-mono">
                                    /{{ $page->slug === 'about' ? 'quem-somos' : ($page->slug === 'sustainability' ? 'sustentabilidade' : ($page->slug === 'social_responsibility' ? 'responsabilidade-social' : ($page->slug === 'posts' ? 'noticias' : ($page->slug === 'careers' ? 'trabalhe-connosco' : 'contactos')))) }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-500 line-clamp-1">
                                {{ $page->subtitle ?: 'Sem subtítulo definido.' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 self-end md:self-center">
                        <a href="{{ route('admin.pages.edit', $page) }}"
                            class="bg-[#45B500] hover:bg-[#3a9900] text-white font-bold text-xs uppercase px-5 py-2.5 rounded-xl transition-all duration-200 shadow-sm flex items-center gap-2">
                            <i class="fas fa-pen-to-square"></i> Editar Conteúdo
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-admin-layout>
