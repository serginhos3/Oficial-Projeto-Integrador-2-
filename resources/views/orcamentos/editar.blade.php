<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Orçamento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end">
                        <a href="{{ route('orcamentos.list') }}" class="bg-gray-800 text-white py-2 px-4 rounded-md">VOLTAR</a>
                    </div>

                    <form method="POST" action="{{ route('orcamentos.atualizar', $orcamento->id) }}" class="mt-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="paciente" class="block text-sm font-medium text-gray-700">Nome do paciente</label>
                            <input type="text" name="paciente" id="paciente" value="{{ old('paciente', $orcamento->paciente) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" placeholder="Digite o nome do paciente">
                        </div>

                        <div class="mt-4">
                            <label for="valor" class="block text-sm font-medium text-gray-700">Valor</label>
                            <input type="text" name="valor" id="valor" value="{{ old('valor', $orcamento->valor) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" placeholder="R$ 0,00">
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
                            <textarea name="procedimento" id="procedimento" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" placeholder="Digite o procedimento">{{ old('procedimento', $orcamento->procedimento) }}</textarea>
                        </div>


                        <div class="mt-4">
                            <label for="dentista" class="block text-sm font-medium text-gray-700">Dentista</label>
                            <input type="text" name="dentista" id="dentista" value="{{ old('dentista', $orcamento->dentista) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" placeholder="Digite o nome do Drº/ª">
                        </div>
                        <div class="mt-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>

                            <!-- Mostrar o status atual antes de editar -->
                            <p class="text-sm text-gray-500">Status atual: <strong>{{ ucfirst($orcamento->status) }}</strong></p>

                            <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                                <option value="" disabled selected>Selecione um status</option> <!-- Opção em branco -->
                                <option value="em aberto" {{ $orcamento->status == 'em aberto' ? 'selected' : '' }}>Em Aberto</option>
                                <option value="pendente" {{ $orcamento->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
                                <option value="em andamento" {{ $orcamento->status == 'em andamento' ? 'selected' : '' }}>Em Andamento</option>
                                <option value="concluido" {{ $orcamento->status == 'concluido' ? 'selected' : '' }}>Concluído</option>
                                <option value="cancelado" {{ $orcamento->status == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                        </div>
                        <div class="mt-4 text-left">
                            <label for="data" class="block text-sm font-medium text-gray-700">Data</label>
                            <input type="date" name="data" id="data" value="{{ old('data', $orcamento->data->format('Y-m-d')) }}" class="mt-1 block w-48 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                        </div>

                        <div class="mt-6 flex justify-center">
                            <button type="submit" class="bg-gray-800 text-white py-2 px-4 rounded-md">Atualizar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>