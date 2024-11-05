<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Início') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-gradient-to-r from-purple-400 to-blue-300 p-4 rounded-lg shadow-md mb-6 text-left">
                <div class="text-white">
                    <h2 class="text-2xl font-bold">
                        {{ __('Bem-Vindo,') }}
                    </h2>
                    <h3 class="text-xl font-light mt-1">
                        {{ Auth::user()->name }}
                    </h3>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                <a
                    class="p-6 bg-yellow-400 rounded-lg shadow-lg border-l-4 border-yellow-500 flex items-center justify-between text-gray-800 transition duration-300 transform hover:bg-yellow-300">
                    <div class="text-4xl">
                        <i class="fas fa-hourglass-start"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl">R$ {{ number_format($valorOrcamentosEmAberto, 2, ',', '.') }}</p>
                        <span class="text-sm font-medium">Valor total em aberto</span>
                    </div>
                </a>

                <a
                    class="p-6 bg-green-400 rounded-lg shadow-lg border-l-4 border-green-600 flex items-center justify-between text-gray-800 transition duration-300 transform hover:bg-green-300">
                    <div class="text-4xl">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl">R$ {{ number_format($valorOrcamentosConcluidos, 2, ',', '.') }}</p>
                        <span class="text-sm font-medium">Valor total concluído</span>
                    </div>
                </a>

                <a
                    class="p-6 bg-red-400 rounded-lg shadow-lg border-l-4 border-red-600 flex items-center justify-between text-gray-800 transition duration-300 transform hover:bg-red-300">
                    <div class="text-4xl">
                        <i class="fas fa-ban"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl">R$ {{ number_format($valorOrcamentosCancelados, 2, ',', '.') }}</p>
                        <span class="text-sm font-medium">Valor total cancelados</span>
                    </div>
                </a>

                <a href="{{ route('orcamentos.list') }}"
                    class="p-6 bg-blue-400 rounded-lg shadow-lg border-l-4 border-blue-600 flex items-center justify-between text-gray-800 transition duration-300 transform hover:bg-blue-300">
                    <div class="text-4xl">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold">Status de Orçamentos</p>
                        <ul class="mt-2 text-sm space-y-1">
                            <li>Em Aberto: <span class="font-semibold">{{ $orcamentosEmAberto }}</span></li>
                            <li>Pendente: <span class="font-semibold">{{ $orcamentosPendentes }}</span></li>
                            <li>Em Andamento: <span class="font-semibold">{{ $orcamentosEmAndamento }}</span></li>
                            <li>Concluído: <span class="font-semibold">{{ $orcamentosConcluidos }}</span></li>
                            <li>Cancelado: <span class="font-semibold">{{ $orcamentosCancelados }}</span></li>
                        </ul>
                    </div>
                </a>

                <a
                    class="p-6 bg-green-400 rounded-lg shadow-lg border-l-4 border-green-600 flex items-center justify-between text-gray-800 transition duration-300 transform hover:bg-green-300">
                    <div class="text-4xl">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold valor" style="display: none;">{{ 'R$' . number_format($valorTotalOrcamentos, 2, ',', '.') }}</p>
                        <p class="text-3xl font-bold valor-oculto">*****</p>
                        <span class="text-sm font-medium">Valor acumulado de todos os orçamentos</span>
                        <button class="ml-2" onclick="toggleValor(event, this)">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                </a>

                <a
                    class="p-6 bg-blue-200 rounded-lg shadow-lg border-l-4 border-blue-400 flex items-center justify-between text-blue-800 transition duration-300 transform hover:bg-blue-300">
                    <div class="text-4xl">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold">{{ $totalOrcamentos }}</p>
                        <span class="text-sm font-medium">Total de orçamentos cadastrados</span>
                    </div>
                </a>

                <a href="{{ route('orcamentos.list') }}"
                    class="p-6 bg-purple-400 rounded-lg shadow-lg border-l-4 border-purple-600 flex items-center justify-between text-gray-800 transition duration-300 transform hover:bg-purple-300">
                    <div class="text-4xl">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold">{{ $totalOrcamentos }}</p>
                        <span class="text-sm font-medium">Orçamentos neste mês</span>
                    </div>
                </a>
                
                <a href="{{ route('pacientes.list') }}"
                    class="p-6 bg-pink-400 rounded-lg shadow-lg border-l-4 border-pink-600 flex items-center justify-between text-gray-800 transition duration-300 transform hover:bg-pink-300">
                    <div class="text-4xl">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold">{{ $novosPacientes }}</p>
                        <span class="text-sm font-medium">Novos pacientes neste mês</span>
                    </div>
                </a>

                <a href="{{ route('pacientes.list') }}"
                    class="p-6 bg-blue-300 rounded-lg shadow-lg border-l-4 border-blue-500 flex items-center justify-between text-gray-800 transition duration-300 transform hover:bg-blue-400">
                    <div class="text-4xl">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold">{{ $totalPacientes }}</p>
                        <span class="text-sm font-medium">Total de pacientes cadastrados</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        function toggleValor(event, button) {
            event.stopPropagation();

            const valorElement = button.parentElement.querySelector('.valor');
            const valorOcultoElement = button.parentElement.querySelector('.valor-oculto');

            if (valorElement.style.display === 'none') {
                valorElement.style.display = 'block';
                valorOcultoElement.style.display = 'none';
                button.querySelector('i').classList.remove('fa-eye');
                button.querySelector('i').classList.add('fa-eye-slash');
            } else {
                valorElement.style.display = 'none';
                valorOcultoElement.style.display = 'block';
                button.querySelector('i').classList.remove('fa-eye-slash');
                button.querySelector('i').classList.add('fa-eye');
            }
        }
    </script>
</x-app-layout>
