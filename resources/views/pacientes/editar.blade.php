<!-- resources/views/pacientes/editar.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Paciente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('pacientes.list') }}" class="bg-gray-800 text-white py-2 px-4 rounded-md">VOLTAR</a>
                    </div>

                    <form method="POST" action="{{ route('pacientes.atualizar', $paciente->id) }}" class="mt-6">
                        @csrf
                        @method('PUT') <!-- Adiciona o método PUT para atualizar -->

                        <div>
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="nome" id="nome" value="{{ old('nome', $paciente->nome) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" placeholder="Digite o nome do paciente">
                        </div>

                        <div class="mt-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $paciente->email) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" placeholder="Digite o email do paciente">
                        </div>

                        <div class="mt-4">
                            <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                            <input type="text" name="telefone" id="telefone" value="{{ old('telefone', $paciente->telefone) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" placeholder="Digite o telefone do paciente">
                        </div>

                        <div class="mt-4">
                            <label for="endereco" class="block text-sm font-medium text-gray-700">Endereço</label>
                            <textarea name="endereco" id="endereco" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" placeholder="Digite o endereço do paciente">{{ old('endereco', $paciente->endereco) }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label for="datanascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                            <input type="date" name="datanascimento" id="datanascimento" value="{{ old('datanascimento', $paciente->datanascimento->format('Y-m-d')) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-gray-800 text-white py-2 px-4 rounded-md">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>