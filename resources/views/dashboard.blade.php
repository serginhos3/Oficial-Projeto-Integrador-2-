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

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                <a href="{{ route('pacientes.list') }}" class="bg-purple-200 p-4 rounded-lg text-gray-800 shadow-md transition duration-300 hover:shadow-lg hover:bg-purple-300">
                    <div class="text-center">
                        <h3 class="text-lg font-medium">Novos Pacientes</h3>
                        <p class="text-3xl font-semibold mt-1">{{ $novosPacientes }}</p>
                        <span class="text-sm mt-1">Pacientes neste mês</span>
                    </div>
                </a>

                <a href="{{ route('pacientes.list') }}" class="bg-blue-200 p-4 rounded-lg text-gray-800 shadow-md transition duration-300 hover:shadow-lg hover:bg-blue-300">
                    <div class="text-center">
                        <h3 class="text-lg font-medium">Pacientes Cadastrados</h3>
                        <p class="text-3xl font-semibold mt-1">{{ $totalPacientes }}</p>
                        <span class="text-sm mt-1">Total de pacientes</span>
                    </div>
                </a>

                <a href="{{ route('orcamentos.list') }}" class="bg-indigo-200 p-4 rounded-lg text-gray-800 shadow-md transition duration-300 hover:shadow-lg hover:bg-indigo-300">
                    <div class="text-center">
                        <h3 class="text-lg font-medium">Orçamentos Novos</h3>
                        <p class="text-3xl font-semibold mt-1">{{ $totalOrcamentos }}</p>
                        <span class="text-sm mt-1">Orçamentos neste mês</span>
                    </div>
                </a>

                <a href="{{ route('orcamentos.list') }}" class="bg-green-200 p-4 rounded-lg text-gray-800 shadow-md transition duration-300 hover:shadow-lg hover:bg-green-300">
                    <div class="text-center">
                        <h3 class="text-lg font-medium">Status dos Orçamentos</h3>
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

                <a href="{{ route('orcamentos.list') }}" class="bg-yellow-200 p-4 rounded-lg text-gray-800 shadow-md transition duration-300 hover:shadow-lg hover:bg-yellow-300">
                    <div class="flex flex-col justify-center items-center h-full text-center">
                        <h3 class="text-lg font-medium">Total de Orçamentos (Valor)</h3>
                        <p class="text-3xl font-semibold mt-1">{{ 'R$' . number_format($valorTotalOrcamentos, 2, ',', '.') }}</p>
                        <span class="text-sm mt-1">Valor acumulado</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
