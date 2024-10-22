<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    {{ __("Você está logado!") }}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                <!-- Card: Novos Pacientes -->
                <a href="{{ route('pacientes.list') }}" class="bg-purple-200 p-6 rounded-lg text-gray-800 shadow-lg transition duration-300 hover:shadow-xl hover:bg-purple-300">
                    <div class="text-center">
                        <h3 class="text-lg font-bold">Novos Pacientes</h3>
                        <p class="text-4xl font-semibold mt-2">{{ $novosPacientes }}</p>
                        <span class="text-sm mt-2">Pacientes neste mês</span>
                    </div>
                </a>

                <!-- Card: Pacientes Cadastrados -->
                <a href="{{ route('pacientes.list') }}" class="bg-blue-200 p-6 rounded-lg text-gray-800 shadow-lg transition duration-300 hover:shadow-xl hover:bg-blue-300">
                    <div class="text-center">
                        <h3 class="text-lg font-bold">Pacientes Cadastrados</h3>
                        <p class="text-4xl font-semibold mt-2">{{ $totalPacientes }}</p>
                        <span class="text-sm mt-2">Total de pacientes</span>
                    </div>
                </a>

                <!-- Card: Orçamentos Cadastrados -->
                <a href="{{ route('orcamentos.list') }}" class="bg-indigo-200 p-6 rounded-lg text-gray-800 shadow-lg transition duration-300 hover:shadow-xl hover:bg-indigo-300">
                    <div class="text-center">
                        <h3 class="text-lg font-bold">Orçamentos Cadastrados</h3>
                        <p class="text-4xl font-semibold mt-2">{{ $totalOrcamentos }}</p>
                        <span class="text-sm mt-2">Total de registros</span>
                    </div>
                </a>

                <!-- Card: Status dos Orçamentos -->
                <a href="{{ route('orcamentos.list') }}" class="bg-green-200 p-6 rounded-lg text-gray-800 shadow-lg transition duration-300 hover:shadow-xl hover:bg-green-300">
                    <div class="text-center">
                        <h3 class="text-lg font-bold">Status dos Orçamentos</h3>
                        <ul class="mt-4 text-left text-sm space-y-1">
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

                <!-- Card: Total de Orçamentos (Valor) -->
                <a href="{{ route('orcamentos.list') }}" class="bg-yellow-200 p-6 rounded-lg text-gray-800 shadow-lg transition duration-300 hover:shadow-xl hover:bg-yellow-300">
                    <div class="flex flex-col justify-center items-center h-full text-center">
                        <h3 class="text-lg font-bold">Total de Orçamentos (Valor)</h3>
                        <p class="text-4xl font-semibold mt-2">{{ 'R$' . number_format($valorTotalOrcamentos, 2, ',', '.') }}</p>
                        <span class="text-sm mt-2">Valor acumulado</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
