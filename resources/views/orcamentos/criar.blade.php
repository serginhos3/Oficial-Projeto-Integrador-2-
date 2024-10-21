<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastro de Orçamento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end">
                        <a href="{{ route('orcamentos.list') }}" class="bg-gray-800 text-white py-2 px-4 rounded-md">VOLTAR</a>
                    </div>

                    <form method="POST" action="{{ route('orcamentos.store') }}" class="mt-6">
                        @csrf

                        <div>
                            <label for="paciente" class="block text-sm font-medium text-gray-700">Nome do paciente</label>
                            <input type="text" name="paciente" id="paciente" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" placeholder="Digite o nome do paciente">
                        </div>

                        <div class="mt-4">
                            <label for="valor" class="block text-sm font-medium text-gray-700">Valor</label>
                            <input type="text" name="valor" id="valor" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" placeholder="R$ 0,00">
                        </div>
                        <script>
                            document.getElementById('valor').addEventListener('input', function(e) {
                                let value = e.target.value.replace(/\D/g, '');
                                value = (value / 100).toFixed(2).replace('.', ',');
                                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                e.target.value = 'R$ ' + value;
                            });
                        </script>

                        <div class="mt-4">
                            <label for="procedimento" class="block text-sm font-medium text-gray-700">Procedimento</label>
                            <textarea name="procedimento" id="procedimento" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" placeholder="Digite o procedimento"></textarea>
                        </div>

                        <div class="mt-4">
                            <label for="dentista" class="block text-sm font-medium text-gray-700">Dentista</label>
                            <input type="text" name="dentista" id="dentista" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" placeholder="Digite o nome do Drº/ª">
                        </div>

                        <div class="mt-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                                <option value="em aberto" selected>Em Aberto</option>
                                <option value="pendente">Pendente</option>
                                <option value="em andamento">Em Andamento</option>
                                <option value="concluido">Concluído</option>
                                <option value="cancelado">Cancelado</option>
                            </select>
                        </div>

                        <div class="mt-4 text-left">
                            <label for="data" class="block text-sm font-medium text-gray-700">Data</label>
                            <input type="date" name="data" id="data" class="mt-1 block w-48 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                        </div>

                        <div class="mt-6 flex justify-center">
                            <button type="submit" class="bg-gray-800 text-white py-2 px-4 rounded-md">Cadastrar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>