<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pacientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('pacientes.cadastrar') }}" class="bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition duration-300">CADASTRAR</a>
                    </div>

                    @if (session('status'))
                    <div class="mb-4 text-green-600 font-semibold">{{ session('status') }}</div>
                    @endif


                    <div class="overflow-x-auto">
                        <table id="pacientesTable" class="min-w-full divide-y divide-gray-200">
                            <!-- Cabeçalho e corpo da tabela -->
                        </table>
                    </div>


                    <div class="overflow-x-auto">
                        <table id="pacientesTable" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nome</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Telefone</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">CEP</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Logradouro</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Número</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Complemento</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Bairro</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Cidade</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Estado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Data de Nascimento</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider w-24">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($pacientes as $paciente)
                                <tr class="hover:bg-gray-100 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->nome }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->telefone }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->cep }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->logradouro }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->numero }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->complemento }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->bairro }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->cidade }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->estado }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->datanascimento->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('pacientes.editar', $paciente->id) }}" class="text-black border-0 bg-transparent hover:bg-transparent" title="Editar">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600" title="Excluir" onclick="return confirm('Você tem certeza que deseja excluir este paciente?');">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if($pacientes->isEmpty())
                        <div class="mt-4 text-gray-500">Nenhum paciente cadastrado.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#pacientesTable').DataTable({
                responsive: true,
                paging: true,
                searching: true,
                order: [
                    [0, 'asc']
                ],
                pageLength: 10,
                lengthChange: false,
                dom: '<"flex justify-between mb-4"<"search-wrapper"f>>t',
                language: {
                    search: "Pesquisar:",
                    lengthMenu: "Mostrar _MENU_ entradas",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                    infoEmpty: "Nenhuma entrada disponível",
                    infoFiltered: "(filtrado de _MAX_ entradas totais)",
                    previous: "Anterior", // Traduzir "Previous"
                    next: "Próximo", // Traduzir "Next"
                    infoEmpty: "Sem registros",
                    zeroRecords: "Sem registros",
                    emptyTable: "Sem registros",
                    paginate: {
                        previous: "Anterior",
                        next: "Próximo"
                    },
                }
            });
        });
    </script>
</x-app-layout>