<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastro de Pacientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end">
                        <a href="{{ route('pacientes.list') }}" class="bg-gray-800 text-white py-2 px-4 rounded-md">VOLTAR</a>
                    </div>

                    <form method="POST" action="{{ route('pacientes.store') }}" class="mt-6">
                        @csrf <!-- Adiciona um token CSRF para segurança -->

                        <div>
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="nome" id="nome" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" placeholder="Digite o nome do paciente">
                        </div>

                        <div class="mt-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" placeholder="Digite o email do paciente">
                        </div>

                        <div class="mt-4">
                            <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                            <input type="text" name="telefone" id="telefone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" placeholder="Digite o telefone do paciente">
                        </div>

                        <div class="mt-4">
                            <label for="endereco" class="block text-sm font-medium text-gray-700">Endereço</label>
                            <textarea name="endereco" id="endereco" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" placeholder="Digite o endereço do paciente"></textarea>
                        </div>

                        <div class="mt-4">
                            <label for="datanascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                            <input type="date" name="datanascimento" id="datanascimento" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-gray-800 text-white py-2 px-4 rounded-md">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
