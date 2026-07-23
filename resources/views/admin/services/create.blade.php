<x-admin-layout>
    <x-slot:header>Adicionar Serviço</x-slot>
    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-6">
        @csrf
        <div class="flex-1 space-y-4">
            <input type="text" name="name" required placeholder="Nome do Serviço (ex: Frescafé)" class="w-full border-gray-300 rounded-xl text-lg px-4 py-3 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors shadow-sm">
            <input type="text" name="slug" placeholder="Slug (opcional - gerado automaticamente)" class="w-full border-gray-300 rounded-xl text-lg px-4 py-3 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors shadow-sm mt-2">
            <div class="bg-white border border-gray-100 shadow-md rounded-xl p-6">
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Descrição</label>
                <textarea name="description" id="editor" rows="6" class="w-full border-gray-300 rounded-lg text-sm px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors"></textarea>
            </div>
        </div>
        <div class="w-full lg:w-[280px] space-y-6">
            <!-- Box: Opções -->
            <div class="bg-white border border-gray-100 shadow-md rounded-xl p-6">
                <div class="font-semibold text-slate-800 text-sm mb-4 border-b border-gray-50 pb-2">Opções de Exibição</div>
                <label class="inline-flex items-center cursor-pointer select-none">
                    <input type="checkbox" name="show_title" value="1" checked class="rounded text-[#45B500] focus:ring-[#45B500] border-gray-300 mr-2">
                    <span class="text-sm font-medium text-slate-700">Mostrar Título no Site</span>
                </label>
            </div>

            <!-- Box: Imagem de Capa -->
            <div class="bg-white border border-gray-100 shadow-md rounded-xl p-6">
                <div class="font-semibold text-slate-800 text-sm mb-4 border-b border-gray-50 pb-2">Imagem de Capa</div>
                <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-[#45B500] hover:file:bg-green-100 cursor-pointer">
            </div>

            <!-- Box: Imagem Adicional (Após o texto) -->
            <div class="bg-white border border-gray-100 shadow-md rounded-xl p-6">
                <div class="font-semibold text-slate-800 text-sm mb-4 border-b border-gray-50 pb-2">Imagem Adicional</div>
                <input type="file" name="additional_image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-[#45B500] hover:file:bg-green-100 cursor-pointer">
                <p class="text-[10px] text-gray-400 mt-2">Imagem opcional que será exibida logo após o parágrafo de texto.</p>
            </div>

            <!-- Box: Botão de Ação -->
            <div class="bg-white border border-gray-100 shadow-md rounded-xl p-6 space-y-4">
                <div class="font-semibold text-slate-800 text-sm border-b border-gray-50 pb-2">Botão de Link (Opcional)</div>
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">Texto do Botão</label>
                    <input type="text" name="btn_text" placeholder="Ex: Aceder ao Portal" class="w-full border-gray-300 rounded-lg text-xs px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">Link do Botão (URL)</label>
                    <input type="text" name="btn_link" placeholder="Ex: https://portal.fresonline.ao ou /lojas" class="w-full border-gray-300 rounded-lg text-xs px-3 py-2 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">Ou Carregar Ficheiro PDF (Download)</label>
                    <input type="file" name="pdf_file" accept="application/pdf" class="w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:bg-green-50 file:text-[#45B500] hover:file:bg-green-100 cursor-pointer">
                    <p class="text-[10px] text-gray-400 mt-1">Carregar um PDF irá substituir o link da URL acima pelo caminho do arquivo.</p>
                </div>
            </div>

            <!-- Box: Publicar -->
            <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden">
                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 font-semibold text-slate-800 text-sm">Publicar</div>
                <div class="bg-gray-50/50 p-4 flex justify-end">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-5 rounded-lg shadow-sm transition-all duration-200 w-full text-center">Criar Serviço</button>
                </div>
            </div>
        </div>
    </form>

    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo'],
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Parágrafo', class: 'ck-heading_paragraph' },
                            { model: 'heading2', view: 'h2', title: 'Subtítulo 1 (H2)', class: 'ck-heading_heading2' },
                            { model: 'heading3', view: 'h3', title: 'Subtítulo 2 (H3)', class: 'ck-heading_heading3' }
                        ]
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
</x-admin-layout>
