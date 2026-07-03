<x-admin-layout>
    <x-slot:header>Mensagem de Contacto #{{ $message->id }}</x-slot>

    <div class="max-w-4xl space-y-6">
        <!-- Message Card -->
        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden">
            <!-- Header section of message -->
            <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 flex flex-wrap justify-between items-center gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-50 text-[#45B500] rounded-full flex items-center justify-center font-bold text-sm uppercase">
                        {{ substr($message->name, 0, 2) }}
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-800 text-sm">{{ $message->name }}</h3>
                        <p class="text-xs text-gray-500">{{ $message->email }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-400">Enviada em</p>
                    <p class="text-xs font-bold text-slate-600">{{ $message->created_at->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>

            <!-- Body and details -->
            <div class="p-6 space-y-6">
                <!-- Subject -->
                <div>
                    <span class="text-2xs font-bold uppercase tracking-wider text-gray-400">Assunto:</span>
                    <h2 class="text-lg font-bold text-slate-800 mt-0.5">{{ $message->subject }}</h2>
                </div>

                <hr class="border-gray-100">

                <!-- Message content -->
                <div>
                    <span class="text-2xs font-bold uppercase tracking-wider text-gray-400">Mensagem:</span>
                    <div class="mt-2 text-sm text-slate-700 leading-relaxed bg-gray-50/50 p-6 rounded-xl border border-gray-100 whitespace-pre-wrap">{!! nl2br(e($message->message)) !!}</div>
                </div>
            </div>

            <!-- Footer actions -->
            <div class="bg-gray-50/50 px-6 py-4 border-t border-gray-100 flex justify-between items-center">
                <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-xl text-xs font-bold text-slate-700 bg-white hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Voltar à Lista
                </a>
                
                <form action="{{ route('admin.contacts.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Deseja realmente apagar esta mensagem permanentemente?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl text-xs font-bold shadow-sm transition-all duration-200">
                        <i class="fas fa-trash-alt mr-2"></i> Apagar Mensagem
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
