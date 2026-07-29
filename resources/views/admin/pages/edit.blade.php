<x-admin-layout>
    <x-slot:header>Editar Página: {{ $page->name }}</x-slot>

    <div class="max-w-4xl space-y-6">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.pages.index') }}" class="text-xs font-bold text-gray-500 hover:text-gray-900 transition-colors inline-flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Voltar ao Gerenciador de Páginas
            </a>
        </div>

        <form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- SECTION 1: CABEÇALHO DA PÁGINA -->
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden">
                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-bold text-slate-800 text-sm flex items-center gap-2">
                    <i class="fas fa-heading text-[#45B500]"></i> Cabeçalho da Página (Título & Subtítulo)
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5">Título Principal da Página *</label>
                        <input type="text" name="title" value="{{ old('title', $page->title) }}" required
                            class="w-full border-gray-300 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 transition-colors">
                        @error('title')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5">Subtítulo / Descrição de Apoio</label>
                        <textarea name="subtitle" rows="2"
                            class="w-full border-gray-300 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 transition-colors">{{ old('subtitle', $page->subtitle) }}</textarea>
                        @error('subtitle')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    @if(!in_array($page->slug, ['contacts', 'posts', 'careers', 'about']))
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5">Imagem de Capa / Banner do Cabeçalho (Opcional)</label>
                            @if($page->banner_image)
                                <div class="mb-3 rounded-xl overflow-hidden max-h-40 border border-gray-100 shadow-sm">
                                    <img src="{{ asset(str_starts_with($page->banner_image, 'http') ? $page->banner_image : $page->banner_image) }}" class="w-full h-40 object-cover">
                                </div>
                            @endif
                            <input type="file" name="banner_image" accept="image/*"
                                class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-[#45B500] hover:file:bg-green-100 cursor-pointer">
                            @error('banner_image')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                </div>
            </div>

            <!-- SECTION 2: CONTEÚDO PRINCIPAL DA PÁGINA -->
            @if(!in_array($page->slug, ['contacts', 'posts']))
                <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden">
                    <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-bold text-slate-800 text-sm flex items-center gap-2">
                        <i class="fas fa-align-left text-[#45B500]"></i> Conteúdo Textual Principal
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5">
                                {{ $page->slug === 'careers' ? 'Título Principal ("Construa o seu Futuro connosco")' : 'Título da Secção de Conteúdo' }}
                            </label>
                            <input type="text" name="content_title" value="{{ old('content_title', $page->content_title) }}"
                                class="w-full border-gray-300 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 transition-colors">
                            @error('content_title')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5">
                                {{ $page->slug === 'careers' ? 'Texto Principal da Cultura & Equipa' : 'Texto Principal da Página' }}
                            </label>
                            <textarea name="content" rows="6"
                                class="w-full border-gray-300 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 transition-colors">{{ old('content', $page->content) }}</textarea>
                            @error('content')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        @if(in_array($page->slug, ['about', 'sustainability', 'social_responsibility', 'careers']))
                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5">
                                    {{ $page->slug === 'careers' ? 'Texto da Secção "Porque trabalhar na Fresmart?"' : 'Texto Adicional / Bloco 1 (Opcional)' }}
                                </label>
                                <textarea name="extra_content_1" rows="4"
                                    class="w-full border-gray-300 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 transition-colors">{{ old('extra_content_1', $page->extra_content_1) }}</textarea>
                                @error('extra_content_1')
                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5">
                                    {{ $page->slug === 'careers' ? 'Texto do Bloco Final "Envie a sua Candidatura"' : 'Texto Adicional / Bloco 2 (Opcional)' }}
                                </label>
                                <textarea name="extra_content_2" rows="4"
                                    class="w-full border-gray-300 rounded-xl text-sm px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 transition-colors">{{ old('extra_content_2', $page->extra_content_2) }}</textarea>
                                @error('extra_content_2')
                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- SECTION 3: IMAGENS DAS PÁGINAS -->
            @if(in_array($page->slug, ['about', 'sustainability', 'social_responsibility', 'careers']))
                <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden">
                    <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-bold text-slate-800 text-sm flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-images text-[#45B500]"></i> Imagens da Página
                        </div>
                        <span class="text-[11px] font-semibold text-gray-400">
                            @if($page->slug === 'about') 4 Imagens (Secções da Barra Lateral)
                            @elseif($page->slug === 'careers') 3 Imagens (Colagem de Carreiras)
                            @else 1 Imagem de Destaque
                            @endif
                        </span>
                    </div>

                    <div class="p-6">
                        @if($page->slug === 'about')
                            <!-- QUEM SOMOS: 4 images for the 4 sidebar tabs -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5">1. Imagem Secção "A Empresa"</label>
                                    @if($page->section_image_1)
                                        <div class="mb-3 rounded-xl overflow-hidden h-36 border border-gray-100 shadow-sm">
                                            <img src="{{ asset(str_starts_with($page->section_image_1, 'http') ? $page->section_image_1 : $page->section_image_1) }}" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="mb-3 rounded-xl overflow-hidden h-36 border border-dashed border-gray-200 bg-gray-50 flex flex-col items-center justify-center text-gray-400 text-xs p-2 text-center">
                                            <img src="{{ asset('placeholder.png') }}" class="h-12 w-auto opacity-50 mb-1">
                                            <span>Placeholder Padrão</span>
                                        </div>
                                    @endif
                                    <input type="file" name="section_image_1" accept="image/*"
                                        class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-[#45B500] hover:file:bg-green-100 cursor-pointer">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5">2. Imagem Secção "O Nosso Sortido"</label>
                                    @if($page->section_image_2)
                                        <div class="mb-3 rounded-xl overflow-hidden h-36 border border-gray-100 shadow-sm">
                                            <img src="{{ asset(str_starts_with($page->section_image_2, 'http') ? $page->section_image_2 : $page->section_image_2) }}" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="mb-3 rounded-xl overflow-hidden h-36 border border-dashed border-gray-200 bg-gray-50 flex flex-col items-center justify-center text-gray-400 text-xs p-2 text-center">
                                            <img src="{{ asset('assets/img/fresmart_sortido.png') }}" class="h-16 w-auto object-cover opacity-80 mb-1">
                                            <span>Imagem Atual em Lojas</span>
                                        </div>
                                    @endif
                                    <input type="file" name="section_image_2" accept="image/*"
                                        class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-[#45B500] hover:file:bg-green-100 cursor-pointer">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5">3. Imagem Secção "A Nossa História"</label>
                                    @if($page->section_image_3)
                                        <div class="mb-3 rounded-xl overflow-hidden h-36 border border-gray-100 shadow-sm">
                                            <img src="{{ asset(str_starts_with($page->section_image_3, 'http') ? $page->section_image_3 : $page->section_image_3) }}" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="mb-3 rounded-xl overflow-hidden h-36 border border-dashed border-gray-200 bg-gray-50 flex flex-col items-center justify-center text-gray-400 text-xs p-2 text-center">
                                            <img src="{{ asset('assets/img/fresmart_historia.png') }}" class="h-16 w-auto object-cover opacity-80 mb-1">
                                            <span>Imagem Atual em Lojas</span>
                                        </div>
                                    @endif
                                    <input type="file" name="section_image_3" accept="image/*"
                                        class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-[#45B500] hover:file:bg-green-100 cursor-pointer">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5">4. Imagem Secção "Nosso Armazém"</label>
                                    @if($page->section_image_4)
                                        <div class="mb-3 rounded-xl overflow-hidden h-36 border border-gray-100 shadow-sm">
                                            <img src="{{ asset(str_starts_with($page->section_image_4, 'http') ? $page->section_image_4 : $page->section_image_4) }}" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="mb-3 rounded-xl overflow-hidden h-36 border border-dashed border-gray-200 bg-gray-50 flex flex-col items-center justify-center text-gray-400 text-xs p-2 text-center">
                                            <img src="{{ asset('placeholder.png') }}" class="h-12 w-auto opacity-50 mb-1">
                                            <span>Placeholder Padrão</span>
                                        </div>
                                    @endif
                                    <input type="file" name="section_image_4" accept="image/*"
                                        class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-[#45B500] hover:file:bg-green-100 cursor-pointer">
                                </div>
                            </div>
                        @elseif($page->slug === 'careers')
                            <!-- Careers collage: 3 images -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5">Imagem da Equipa 1</label>
                                    @if($page->section_image_1)
                                        <div class="mb-3 rounded-xl overflow-hidden h-32 border border-gray-100 shadow-sm">
                                            <img src="{{ asset(str_starts_with($page->section_image_1, 'http') ? $page->section_image_1 : $page->section_image_1) }}" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="mb-3 rounded-xl overflow-hidden h-32 border border-dashed border-gray-200 bg-gray-50 flex flex-col items-center justify-center text-gray-400 text-xs p-2 text-center">
                                            <img src="{{ asset('placeholder.png') }}" class="h-12 w-auto opacity-50 mb-1">
                                            <span>Placeholder Padrão</span>
                                        </div>
                                    @endif
                                    <input type="file" name="section_image_1" accept="image/*"
                                        class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-[#45B500] hover:file:bg-green-100 cursor-pointer">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5">Imagem da Equipa 2</label>
                                    @if($page->section_image_2)
                                        <div class="mb-3 rounded-xl overflow-hidden h-32 border border-gray-100 shadow-sm">
                                            <img src="{{ asset(str_starts_with($page->section_image_2, 'http') ? $page->section_image_2 : $page->section_image_2) }}" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="mb-3 rounded-xl overflow-hidden h-32 border border-dashed border-gray-200 bg-gray-50 flex flex-col items-center justify-center text-gray-400 text-xs p-2 text-center">
                                            <img src="{{ asset('placeholder.png') }}" class="h-12 w-auto opacity-50 mb-1">
                                            <span>Placeholder Padrão</span>
                                        </div>
                                    @endif
                                    <input type="file" name="section_image_2" accept="image/*"
                                        class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-[#45B500] hover:file:bg-green-100 cursor-pointer">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5">Imagem da Equipa 3 (Ambiente)</label>
                                    @if($page->section_image_3)
                                        <div class="mb-3 rounded-xl overflow-hidden h-32 border border-gray-100 shadow-sm">
                                            <img src="{{ asset(str_starts_with($page->section_image_3, 'http') ? $page->section_image_3 : $page->section_image_3) }}" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="mb-3 rounded-xl overflow-hidden h-32 border border-dashed border-gray-200 bg-gray-50 flex flex-col items-center justify-center text-gray-400 text-xs p-2 text-center">
                                            <img src="{{ asset('placeholder.png') }}" class="h-12 w-auto opacity-50 mb-1">
                                            <span>Placeholder Padrão</span>
                                        </div>
                                    @endif
                                    <input type="file" name="section_image_3" accept="image/*"
                                        class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-[#45B500] hover:file:bg-green-100 cursor-pointer">
                                </div>
                            </div>
                        @else
                            <!-- Pages with 1 single main section image (Sustainability, Social Responsibility) -->
                            <div class="max-w-md">
                                <label class="block text-xs font-bold text-slate-600 uppercase mb-1.5">Imagem Ilustrativa Principal da Secção</label>
                                @if($page->section_image_1)
                                    <div class="mb-3 rounded-xl overflow-hidden h-48 border border-gray-100 shadow-sm">
                                        <img src="{{ asset(str_starts_with($page->section_image_1, 'http') ? $page->section_image_1 : $page->section_image_1) }}" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="mb-3 rounded-xl overflow-hidden h-44 border border-dashed border-gray-200 bg-gray-50 flex flex-col items-center justify-center text-gray-400 text-xs p-3 text-center">
                                        <img src="{{ asset('placeholder.png') }}" class="h-14 w-auto opacity-50 mb-1">
                                        <span>Nenhuma imagem carregada (exibindo placeholder.png)</span>
                                    </div>
                                @endif
                                <input type="file" name="section_image_1" accept="image/*"
                                    class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-[#45B500] hover:file:bg-green-100 cursor-pointer">
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            @if($page->slug === 'contacts')
                <div class="bg-green-50 border border-green-200 rounded-2xl p-5 text-green-900 text-xs flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-info-circle text-lg text-[#45B500]"></i>
                        <p>Os contactos diretos (E-mail, Telefones, Sede e Iframe do Google Maps) são geridos centralmente no menu <a href="{{ route('admin.settings.edit') }}" class="font-bold underline">Configurações Globais</a> do CMS.</p>
                    </div>
                </div>
            @endif

            @if($page->slug === 'posts')
                <div class="bg-blue-50 border border-blue-200 rounded-2xl p-5 text-blue-900 text-xs flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-newspaper text-lg text-blue-600"></i>
                        <p>Os artigos e notícias individuais são publicados e geridos no módulo <a href="{{ route('admin.posts.index') }}" class="font-bold underline">Notícias</a> do CMS.</p>
                    </div>
                </div>
            @endif

            <!-- SUBMIT BUTTON -->
            <div class="flex items-center justify-end gap-4 pt-4">
                <a href="{{ route('admin.pages.index') }}" class="px-6 py-3 rounded-xl text-xs font-bold text-gray-500 hover:text-gray-900 transition-colors uppercase">Cancelar</a>
                <button type="submit" class="bg-[#45B500] hover:bg-[#3a9900] text-white font-bold text-xs uppercase px-8 py-3.5 rounded-2xl shadow-md transition-all duration-300 cursor-pointer flex items-center gap-2">
                    <i class="fas fa-floppy-disk"></i> Guardar Alterações da Página
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
