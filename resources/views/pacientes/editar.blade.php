<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Paciente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('pacientes.list') }}" class="bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition">VOLTAR</a>
                    </div>

                    <form method="POST" action="{{ route('pacientes.atualizar', $paciente->id) }}" class="mt-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="nome" id="nome" value="{{ old('nome', $paciente->nome) }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Digite o nome do paciente">
                        </div>

                        <div class="mt-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $paciente->email) }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Digite o email do paciente">
                        </div>

                        <div class="mt-4">
                            <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                            <input type="text" name="telefone" id="telefone" value="{{ old('telefone', $paciente->telefone) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Digite o telefone do paciente">
                        </div>

                        <div class="mt-4">
                            <label for="datanascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                            <input type="date" name="datanascimento" id="datanascimento" value="{{ old('datanascimento', $paciente->datanascimento->format('Y-m-d')) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 transition" required>
                        </div>

                        <div class="mt-6 bg-gray-100 p-6 rounded-lg shadow-md w-full">
                            <h3 class="text-lg font-semibold mb-4 text-gray-800">Endereço</h3>

                            <div class="space-y-4">
                                <div>
                                    <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
                                    <input type="text" name="cep" id="cep" value="{{ old('cep', $paciente->cep) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Informe o CEP" onblur="buscarEndereco()">
                                </div>
                                <div>
                                    <label for="logradouro" class="block text-sm font-medium text-gray-700">Logradouro</label>
                                    <input type="text" name="logradouro" id="logradouro" value="{{ old('logradouro', $paciente->logradouro) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Rua/Avenida">
                                </div>
                                <div>
                                    <label for="numero" class="block text-sm font-medium text-gray-700">Número</label>
                                    <input type="text" name="numero" id="numero" value="{{ old('numero', $paciente->numero) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Nº">
                                </div>
                                <div>
                                    <label for="complemento" class="block text-sm font-medium text-gray-700">Complemento</label>
                                    <input type="text" name="complemento" id="complemento" value="{{ old('complemento', $paciente->complemento) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Complemento">
                                </div>
                                <div>
                                    <label for="bairro" class="block text-sm font-medium text-gray-700">Bairro</label>
                                    <input type="text" name="bairro" id="bairro" value="{{ old('bairro', $paciente->bairro) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Bairro">
                                </div>
                                <div>
                                    <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade</label>
                                    <input type="text" name="cidade" id="cidade" value="{{ old('cidade', $paciente->cidade) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Cidade">
                                </div>
                                <div>
                                    <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                                    <input type="text" name="estado" id="estado" value="{{ old('estado', $paciente->estado) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Estado">
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#telefone').mask('00 00000-0000');
        });

        async function buscarEndereco() {
            const cep = document.getElementById('cep').value;
            const apiKey = "{{ env('GOOGLE_MAPS_API_KEY') }}";
            const url = `https://maps.googleapis.com/maps/api/geocode/json?address=${cep}&key=${apiKey}`;

            try {
                const response = await fetch(url);
                const data = await response.json();

                if (data.status === 'OK') {
                    const address = data.results[0].address_components;

                    address.forEach(component => {
                        if (component.types.includes("route")) {
                            document.getElementById('logradouro').value = component.long_name;
                        }
                        if (component.types.includes("locality") || component.types.includes("sublocality") || component.types.includes("postal_town")) {
                            document.getElementById('bairro').value = component.long_name;
                        }
                        if (component.types.includes("locality") || component.types.includes("administrative_area_level_2")) {
                            document.getElementById('cidade').value = component.long_name;
                        }
                        if (component.types.includes("administrative_area_level_1")) {
                            document.getElementById('estado').value = component.short_name;
                        }
                    });
                } else {
                    alert("Endereço não encontrado. Verifique o CEP.");
                }
            } catch (error) {
                console.error("Erro ao buscar endereço:", error);
                alert("Erro ao buscar endereço.");
            }
        }

        document.getElementById('datanascimento').addEventListener('change', function() {
            const birthDate = new Date(this.value);
            const today = new Date();
            const age = today.getFullYear() - birthDate.getFullYear();

            if (today < new Date(today.getFullYear(), birthDate.getMonth(), birthDate.getDate())) {
                age--;
            }

            alert(`Idade do paciente: ${age}`);
        });
    </script>
</x-app-layout>
