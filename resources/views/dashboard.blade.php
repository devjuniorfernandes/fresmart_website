<x-admin-layout>
    <x-slot:header>Painel de Controlo</x-slot>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 max-w-7xl">
        <!-- Visits Card -->
        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6 flex items-center justify-between hover:shadow-md transition-shadow duration-300">
            <div>
                <span class="text-2xs font-bold text-gray-400 uppercase tracking-wider">Visitas Totais</span>
                <h3 class="text-3xl font-extrabold text-slate-800 mt-1">{{ number_format($visitsCount) }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 text-xl">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>

        <!-- Stores Card -->
        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6 flex items-center justify-between hover:shadow-md transition-shadow duration-300">
            <div>
                <span class="text-2xs font-bold text-gray-400 uppercase tracking-wider">Lojas Ativas</span>
                <h3 class="text-3xl font-extrabold text-slate-800 mt-1">{{ $storesCount }}</h3>
            </div>
            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-[#45B500] text-xl">
                <i class="fas fa-store"></i>
            </div>
        </div>

        <!-- Campaigns Card -->
        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6 flex items-center justify-between hover:shadow-md transition-shadow duration-300">
            <div>
                <span class="text-2xs font-bold text-gray-400 uppercase tracking-wider">Campanhas / Ofertas</span>
                <h3 class="text-3xl font-extrabold text-slate-800 mt-1">{{ $campaignsCount }}</h3>
            </div>
            <div class="w-12 h-12 bg-yellow-50 rounded-xl flex items-center justify-center text-yellow-600 text-xl">
                <i class="fas fa-bullhorn"></i>
            </div>
        </div>

        <!-- Services Card -->
        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6 flex items-center justify-between hover:shadow-md transition-shadow duration-300">
            <div>
                <span class="text-2xs font-bold text-gray-400 uppercase tracking-wider">Serviços</span>
                <h3 class="text-3xl font-extrabold text-slate-800 mt-1">{{ $servicesCount }}</h3>
            </div>
            <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600 text-xl">
                <i class="fas fa-concierge-bell"></i>
            </div>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8 max-w-7xl">
        <!-- Visits Line Chart -->
        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6 lg:col-span-2 flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4 border-b border-gray-50 pb-3">
                <h3 class="font-bold text-slate-800 text-sm flex items-center gap-2">
                    <i class="fas fa-chart-area text-[#45B500]"></i> Tráfego do Site (Últimos 30 Dias)
                </h3>
            </div>
            <div class="w-full h-80 relative">
                <canvas id="visitsChart"></canvas>
            </div>
        </div>

        <!-- Content Proportion Pie Chart -->
        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6 lg:col-span-1 flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4 border-b border-gray-50 pb-3">
                <h3 class="font-bold text-slate-800 text-sm flex items-center gap-2">
                    <i class="fas fa-chart-pie text-[#45B500]"></i> Distribuição de Conteúdo
                </h3>
            </div>
            <div class="w-full h-80 relative flex items-center justify-center">
                <canvas id="proportionChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Info & Latest Messages Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 max-w-7xl">
        <!-- Welcome Card & Quick Info -->
        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6 lg:col-span-1 flex flex-col justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-800 tracking-tight mb-2">Bem-vindo(a) ao Fresmart CMS!</h2>
                <p class="text-xs text-gray-500 leading-relaxed">Este é o painel administrativo do website da Fresmart. A partir daqui pode gerir slides de capa, listagem de lojas, receitas, campanhas de ofertas, produtos e páginas de serviços.</p>
            </div>
            <div class="mt-6 border-t border-gray-50 pt-4 space-y-3">
                <div class="flex items-center justify-between text-xs text-gray-500">
                    <span>Categorias de Produtos</span>
                    <span class="font-bold text-slate-700">{{ $productsCount }}</span>
                </div>
                <div class="flex items-center justify-between text-xs text-gray-500">
                    <span>Receitas Cadastradas</span>
                    <span class="font-bold text-slate-700">{{ $recipesCount }}</span>
                </div>
            </div>
        </div>

        <!-- Latest Contact Messages -->
        <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6 lg:col-span-2">
            <div class="flex items-center justify-between mb-4 border-b border-gray-50 pb-3">
                <h3 class="font-bold text-slate-800 text-sm flex items-center gap-2">
                    <i class="fas fa-envelope text-[#45B500]"></i> Últimas Mensagens Recebidas
                    @if($unreadMessagesCount > 0)
                        <span class="bg-red-500 text-white text-2xs font-extrabold px-2 py-0.5 rounded-full ml-1 animate-pulse">{{ $unreadMessagesCount }} novas</span>
                    @endif
                </h3>
                <a href="{{ route('admin.contacts.index') }}" class="text-xs font-bold text-[#45B500] hover:underline">Ver todas</a>
            </div>
            
            <div class="space-y-4">
                @forelse($latestMessages as $msg)
                    <div class="flex items-start justify-between p-3 rounded-xl border {{ !$msg->is_read ? 'bg-green-50/10 border-green-100' : 'border-gray-50 bg-gray-50/10' }} transition-colors">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-2xs uppercase flex-shrink-0">
                                {{ substr($msg->name, 0, 2) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-xs flex items-center gap-1.5">
                                    {{ $msg->name }}
                                    @if(!$msg->is_read)
                                        <span class="w-1.5 h-1.5 bg-[#45B500] rounded-full"></span>
                                    @endif
                                </h4>
                                <p class="text-2xs text-gray-500">{{ $msg->email }}</p>
                                <p class="text-xs text-slate-700 mt-1 font-bold">{{ $msg->subject }}</p>
                                <p class="text-2xs text-gray-400 mt-0.5 line-clamp-1">{{ strip_tags($msg->message) }}</p>
                            </div>
                        </div>
                        <div class="text-right flex flex-col items-end gap-1 flex-shrink-0">
                            <span class="text-2xs text-gray-400">{{ $msg->created_at->diffForHumans() }}</span>
                            <a href="{{ route('admin.contacts.show', $msg->id) }}" class="text-2xs font-bold text-[#45B500] hover:underline">Ler</a>
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center text-gray-400 text-xs">
                        <i class="fas fa-inbox text-2xl mb-2 block text-gray-300"></i>
                        Nenhuma mensagem recebida ainda.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // 1. Visits Line Chart
            const visitsCtx = document.getElementById('visitsChart').getContext('2d');
            new Chart(visitsCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartLabels) !!},
                    datasets: [{
                        label: 'Visitas Únicas',
                        data: {!! json_encode($chartData) !!},
                        borderColor: '#45B500',
                        backgroundColor: 'rgba(69, 181, 0, 0.05)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.3,
                        pointBackgroundColor: '#45B500',
                        pointBorderColor: '#fff',
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f3f4f6'
                            },
                            ticks: {
                                stepSize: 1,
                                font: {
                                    size: 10
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 10
                                }
                            }
                        }
                    }
                }
            });

            // 2. Proportion Doughnut Chart
            const proportionCtx = document.getElementById('proportionChart').getContext('2d');
            new Chart(proportionCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($proportionLabels) !!},
                    datasets: [{
                        data: {!! json_encode($proportionData) !!},
                        backgroundColor: [
                            '#45B500', // Lojas (Green)
                            '#f59e0b', // Campanhas (Amber)
                            '#8b5cf6', // Serviços (Purple)
                            '#ec4899', // Receitas (Pink)
                            '#3b82f6'  // Produtos (Blue)
                        ],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                padding: 15,
                                font: {
                                    size: 10,
                                    weight: 'bold'
                                }
                            }
                        }
                    },
                    cutout: '65%'
                }
            });
        });
    </script>
</x-admin-layout>
