<x-admin-layout>
    <x-slot:header>Candidaturas a Emprego (Recrutamento)</x-slot>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-xl shadow-sm text-sm">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white border border-gray-100 shadow-md rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-[13px]">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/50">
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Nome / Contacto</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Vaga Pretendida</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Data de Envio</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Currículo</th>
                        <th class="py-3 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/6">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $app)
                        <tr class="border-b border-gray-50 hover:bg-gray-50 group transition-colors duration-150">
                            <td class="py-4 px-4 align-top">
                                <strong class="text-slate-800 text-sm block">{{ $app->name }}</strong>
                                <span class="text-gray-500 text-xs block mt-0.5">{{ $app->email }} | {{ $app->phone }}</span>
                            </td>
                            <td class="py-4 px-4 align-top font-semibold text-gray-700">
                                {{ $app->position }}
                            </td>
                            <td class="py-4 px-4 align-top text-gray-600">
                                {{ $app->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="py-4 px-4 align-top text-xs">
                                @if($app->cv_path)
                                    <a href="{{ asset($app->cv_path) }}" target="_blank" class="text-green-600 hover:underline font-bold flex items-center gap-1">
                                        <i class="far fa-file-alt"></i> Baixar CV
                                    </a>
                                @else
                                    <span class="text-gray-400">Nenhum</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 align-top">
                                <a href="{{ route('admin.applications.show', $app->id) }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors mr-2">Ver detalhes</a>
                                <form action="{{ route('admin.applications.destroy', $app->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem a certeza?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition-colors">Apagar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-6 px-4 text-center text-gray-500">Nenhuma candidatura recebida ainda.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($applications->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $applications->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
