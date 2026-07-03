<x-admin-layout>
    <x-slot:header>Mensagens de Contacto</x-slot>

    <!-- Filters and Search -->
    <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-4 mb-6 max-w-7xl">
        <form action="{{ route('admin.contacts.index') }}" method="GET" class="flex flex-col md:flex-row gap-3 items-center justify-between">
            <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                <!-- Status Filter -->
                <div>
                    <select name="status" onchange="this.form.submit()" 
                            class="border-gray-300 rounded-xl text-xs px-4 py-2.5 focus:border-green-500 focus:ring focus:ring-green-100 transition-colors">
                        <option value="">Todos os Status</option>
                        <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Não Lidas</option>
                        <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Lidas</option>
                    </select>
                </div>
            </div>

            <!-- Search input -->
            <div class="relative w-full md:w-80">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Pesquisar mensagens..."
                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-xl text-xs focus:border-green-500 focus:ring focus:ring-green-100 focus:outline-none transition-colors">
            </div>
        </form>
    </div>

    <!-- Messages List -->
    <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden max-w-7xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-[13px] border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/50">
                        <th class="py-3.5 px-6 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/12">Status</th>
                        <th class="py-3.5 px-6 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/4">Remetente</th>
                        <th class="py-3.5 px-6 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/3">Assunto</th>
                        <th class="py-3.5 px-6 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/6">Enviado em</th>
                        <th class="py-3.5 px-6 text-xs font-semibold uppercase tracking-wider text-gray-500 w-1/6 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages ?? [] as $msg)
                        <tr class="border-b border-gray-100 hover:bg-[#f6f7f7] transition-colors {{ !$msg->is_read ? 'font-semibold bg-green-50/10' : '' }}">
                            <td class="py-4 px-6 align-middle">
                                @if(!$msg->is_read)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-2xs font-bold bg-green-100 text-[#45B500] uppercase tracking-wider">Novo</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-2xs font-bold bg-gray-100 text-gray-400 uppercase tracking-wider">Lida</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 align-middle">
                                <div class="text-sm font-bold text-slate-800">{{ $msg->name }}</div>
                                <div class="text-xs text-gray-500 font-normal">{{ $msg->email }}</div>
                            </td>
                            <td class="py-4 px-6 align-middle text-slate-700">
                                <div class="line-clamp-1">{{ $msg->subject }}</div>
                                <div class="text-xs text-gray-400 font-normal line-clamp-1">{{ Str::limit(strip_tags($msg->message), 80) }}</div>
                            </td>
                            <td class="py-4 px-6 align-middle text-gray-500 text-xs">
                                {{ $msg->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="py-4 px-6 align-middle text-right space-x-2">
                                <a href="{{ route('admin.contacts.show', $msg->id) }}" class="inline-flex items-center px-3 py-1.5 bg-slate-100 hover:bg-[#45B500] hover:text-white rounded-lg text-slate-700 text-xs font-bold transition-all duration-200">
                                    Visualizar
                                </a>
                                <form action="{{ route('admin.contacts.destroy', $msg->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Deseja realmente apagar esta mensagem permanentemente?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 hover:bg-red-600 hover:text-white rounded-lg text-red-600 text-xs font-bold transition-all duration-200">
                                        Apagar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 px-6 text-center text-gray-400">
                                <i class="fas fa-inbox text-3xl mb-3 block text-gray-300"></i>
                                Nenhuma mensagem de contacto recebida no momento.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
