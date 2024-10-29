<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastro de Orçamento') }}
        </h2>
    </x-slot>

    @if($errors->any())
    <div class="bg-red-500 text-white p-4 rounded-md mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end">
                        <a href="{{ route('orcamentos.list') }}" class="bg-gray-800 text-white py-2 px-4 rounded-md">VOLTAR</a>
                    </div>

                    <form method="POST" action="{{ route('orcamentos.store') }}" class="mt-6">
                        @csrf

                        <div class="relative mt-1">
                            <label for="idpaciente" class="block text-sm font-medium text-gray-700">Selecione o Paciente:</label>
                            <input type="text" id="paciente" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" placeholder="Digite o nome do paciente" autocomplete="off">
                            <ul id="sugestoes" class="border rounded-md bg-blue-100 hidden absolute z-10 w-full max-h-40 overflow-auto shadow-lg transition-all duration-300"></ul>
                            <input type="hidden" name="idpaciente" id="idpaciente">
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
                            <input type="date" name="data" id="data" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="mt-1 block w-48 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
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

<script>
    document.getElementById('paciente').addEventListener('input', function() {
        const query = this.value;
        if (query.length < 2) {
            document.getElementById('sugestoes').classList.add('hidden');
            return;
        }

        fetch(`/pacientes/buscar?query=${query}`)
            .then(response => response.json())
            .then(pacientes => {
                const sugestoes = document.getElementById('sugestoes');
                sugestoes.innerHTML = '';
                pacientes.forEach(paciente => {
                    const li = document.createElement('li');
                    li.textContent = paciente.nome;
                    li.classList.add('px-4', 'py-2', 'cursor-pointer', 'hover:bg-blue-200'); // Hover em azul mais claro
                    li.addEventListener('click', () => {
                        document.getElementById('paciente').value = paciente.nome;
                        document.getElementById('idpaciente').value = paciente.id;
                        sugestoes.classList.add('hidden');
                    });
                    sugestoes.appendChild(li);
                });
                sugestoes.classList.remove('hidden');
            });
    });

    document.addEventListener('click', function(event) {
        const pacienteInput = document.getElementById('paciente');
        const sugestoes = document.getElementById('sugestoes');

        if (!pacienteInput.contains(event.target) && !sugestoes.contains(event.target)) {
            sugestoes.classList.add('hidden');
        }
    });
</script>
