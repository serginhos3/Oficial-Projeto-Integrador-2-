<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-blue-300 to-purple-300 p-4 rounded-lg shadow-lg mb-6 text-left bg-opacity-70">
                <div class="text-gray-900">
                    <h2 class="text-2xl font-bold">
                        {{ __("Bem-Vindo,") }}
                    </h2>
                    <h3 class="text-xl font-light mt-1">
                        {{ Auth::user()->name }}
                    </h3>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <a href="{{ route('pacientes.list') }}" class="bg-green-300 p-4 rounded-lg text-gray-800 shadow-lg transition duration-300 hover:shadow-xl hover:bg-green-400">
                    <div class="text-center">
                        <h3 class="text-lg font-light">Novos Pacientes</h3>
                        <p class="text-3xl font-semibold mt-1">{{ $novosPacientes }}</p>
                        <span class="text-sm mt-1">Pacientes neste mês</span>
                    </div>
                </a>

                <a href="{{ route('pacientes.list') }}" class="bg-indigo-300 p-4 rounded-lg text-gray-800 shadow-lg transition duration-300 hover:shadow-xl hover:bg-indigo-400">
                    <div class="text-center">
                        <h3 class="text-lg font-light">Pacientes Cadastrados</h3>
                        <p class="text-3xl font-semibold mt-1">{{ $totalPacientes }}</p>
                        <span class="text-sm mt-1">Total de pacientes</span>
                    </div>
                </a>

                <a href="{{ route('orcamentos.list') }}" class="bg-blue-300 p-4 rounded-lg text-gray-800 shadow-lg transition duration-300 hover:shadow-xl hover:bg-blue-400">
                    <div class="text-center">
                        <h3 class="text-lg font-light">Novos Orçamentos</h3>
                        <p class="text-3xl font-semibold mt-1">{{ $totalOrcamentos }}</p>
                        <span class="text-sm mt-1">Orçamentos neste mês</span>
                    </div>
                </a>

                <a href="{{ route('orcamentos.list') }}" class="bg-yellow-300 p-4 rounded-lg text-gray-800 shadow-lg transition duration-300 hover:shadow-xl hover:bg-yellow-400">
                    <div class="text-center">
                        <h3 class="text-lg font-light">Status dos Orçamentos</h3>
                        <ul class="mt-2 text-left text-sm space-y-1">
                            <li class="flex justify-between">
                                <span>Em Aberto:</span>
                                <span class="font-semibold">{{ $orcamentosEmAberto }}</span>
                            </li>
                            <li class="flex justify-between">
                                <span>Pendente:</span>
                                <span class="font-semibold">{{ $orcamentosPendentes }}</span>
                            </li>
                            <li class="flex justify-between">
                                <span>Em Andamento:</span>
                                <span class="font-semibold">{{ $orcamentosEmAndamento }}</span>
                            </li>
                            <li class="flex justify-between">
                                <span>Concluído:</span>
                                <span class="font-semibold">{{ $orcamentosConcluidos }}</span>
                            </li>
                            <li class="flex justify-between">
                                <span>Cancelado:</span>
                                <span class="font-semibold">{{ $orcamentosCancelados }}</span>
                            </li>
                        </ul>
                    </div>
                </a>

                <!-- Card de Valor Acumulado -->
                <a class="bg-purple-300 p-4 rounded-lg text-gray-800 shadow-lg transition duration-300 hover:shadow-xl hover:bg-purple-400">
                    <div class="flex flex-col justify-center items-center h-full text-center">
                        <h3 class="text-lg font-light">Total de Orçamentos (Valor)</h3>
                        <p class="text-3xl font-semibold mt-1 valor" style="display: none;">{{ 'R$' . number_format($valorTotalOrcamentos, 2, ',', '.') }}</p>
                        <p class="text-3xl font-semibold mt-1 valor-oculto">*****</p>
                        <span class="text-sm mt-1">Valor acumulado</span>
                        <button class="mt-2" onclick="toggleValor(event, this)">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                </a>

                <!-- Card para Quantidade Total de Orçamentos -->
                <a class="bg-red-300 p-4 rounded-lg text-gray-800 shadow-lg transition duration-300 hover:shadow-xl hover:bg-red-400">
                    <div class="flex flex-col justify-center items-center h-full text-center">
                        <h3 class="text-lg font-light">Quantidade Total de Orçamentos</h3>
                        <p class="text-3xl font-semibold mt-1">{{ $totalOrcamentos }}</p>
                        <span class="text-sm mt-1">Total de orçamentos cadastrados</span>
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
