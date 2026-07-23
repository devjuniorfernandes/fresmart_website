<x-admin-layout>
    <x-slot:header>Detalhes da Candidatura</x-slot>

    <div class="max-w-3xl space-y-6">
        <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden p-6 space-y-6">
            <div class="border-b border-gray-100 pb-4 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">{{ $application->name }}</h2>
                    <p class="text-xs text-gray-500 mt-1">Candidatura enviada em {{ $application->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <a href="{{ route('admin.applications.index') }}" class="text-[#45B500] font-bold text-xs hover:underline">&larr; Voltar à lista</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <span class="block text-xs font-bold text-gray-400 uppercase">E-mail</span>
                    <a href="mailto:{{ $application->email }}" class="text-sm font-semibold text-[#45B500] hover:underline">{{ $application->email }}</a>
                </div>
                <div>
                    <span class="block text-xs font-bold text-gray-400 uppercase">Telefone</span>
                    <a href="tel:{{ $application->phone }}" class="text-sm font-semibold text-[#45B500] hover:underline">{{ $application->phone }}</a>
                </div>
                <div>
                    <span class="block text-xs font-bold text-gray-400 uppercase">Vaga Pretendida</span>
                    <span class="text-sm font-semibold text-gray-800">{{ $application->position }}</span>
                </div>
                <div>
                    <span class="block text-xs font-bold text-gray-400 uppercase">Currículo</span>
                    @if($application->cv_path)
                        <a href="{{ asset($application->cv_path) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-white bg-green-600 hover:bg-green-700 px-3 py-1.5 rounded-lg mt-1 transition-all shadow-sm">
                            <i class="fas fa-file-download"></i> Baixar Documento
                        </a>
                    @else
                        <span class="text-sm font-medium text-gray-500 mt-1 block">Nenhum documento carregado.</span>
                    @endif
                </div>
            </div>

            <hr class="border-gray-100">

            <div>
                <span class="block text-xs font-bold text-gray-400 uppercase mb-2">Mensagem do Candidato</span>
                <div class="bg-gray-50 rounded-xl p-4 text-sm text-gray-700 leading-relaxed whitespace-pre-wrap">
                    {{ $application->message ?: 'Sem mensagem adicional.' }}
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <form action="{{ route('admin.applications.destroy', $application->id) }}" method="POST" onsubmit="return confirm('Tem a certeza?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2.5 px-6 rounded-xl shadow-sm text-sm transition-all duration-200">
                    Apagar Candidatura
                </button>
            </form>
        </div>
    </div>
</x-admin-layout>
