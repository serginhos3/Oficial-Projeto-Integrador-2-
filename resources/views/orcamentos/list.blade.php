<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orçamentos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('orcamentos.criar') }}" class="bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition duration-300">CADASTRAR</a>
                    </div>

                    @if (session('status'))
                    <div class="mb-4 text-green-600 font-semibold">{{ session('status') }}</div>
                    @endif

                    <div class="overflow-x-auto">
                        <table id="orcamentosTable" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Paciente</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Valor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Procedimento</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Dentista</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Data</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($orcamentos as $orcamento)
                                <tr class="hover:bg-gray-100 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $orcamento->paciente }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $orcamento->valor }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $orcamento->procedimento }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $orcamento->dentista }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select name="status" id="status-{{ $orcamento->id }}" class="bg-transparent text-gray-900 text-sm rounded-lg block w-full p-2.5 text-center" style="border: 1px solid transparent; outline: none;">
                                            <option value="em aberto" style="color: turquoise;" {{ $orcamento->status === 'em aberto' ? 'selected' : '' }}>Em Aberto</option>
                                            <option value="pendente" style="color: orange;" {{ $orcamento->status === 'pendente' ? 'selected' : '' }}>Pendente</option>
                                            <option value="em andamento" style="color: blue;" {{ $orcamento->status === 'em andamento' ? 'selected' : '' }}>Em Andamento</option>
                                            <option value="concluído" style="color: green;" {{ $orcamento->status === 'concluído' ? 'selected' : '' }}>Concluído</option>
                                            <option value="cancelado" style="color: red;" {{ $orcamento->status === 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $orcamento->data->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('orcamentos.editar', $orcamento->id) }}" class="text-black border-0 bg-transparent hover:bg-transparent" title="Editar">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <form action="{{ route('orcamentos.destroy', $orcamento->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600" title="Excluir" onclick="return confirm('Você tem certeza que deseja excluir este orçamento?');">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if($orcamentos->isEmpty())
                        <div class="mt-4 text-gray-500">Nenhum orçamento cadastrado.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#orcamentosTable').DataTable({
                responsive: true,
                paging: true,
                searching: true,
                order: [
                    [0, 'asc']
                ],
                pageLength: 10,
                lengthChange: false,
                language: {
                    search: "Pesquisar:",
                    lengthMenu: "Mostrar _MENU_ entradas",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                    infoEmpty: "Nenhuma entrada disponível",
                    infoFiltered: "(filtrado de _MAX_ entradas totais)",
                    previous: "Anterior",
                    next: "Próximo",
                    infoEmpty: "Sem registros",
                    zeroRecords: "Sem registros",
                    emptyTable: "Sem registros",
                    paginate: {
                        previous: "Anterior",
                        next: "Próximo"
                    },
                }
            });

            // Função para mudar a cor do texto do dropdown com base na seleção
            $('select[name="status"]').change(function() {
                var status = $(this).val();
                var color;

                switch(status) {
                    case 'em aberto':
                        color = 'turquoise';
                        break;
                    case 'pendente':
                        color = 'orange';
                        break;
                    case 'em andamento':
                        color = 'blue';
                        break;
                    case 'concluído':
                        color = 'green';
                        break;
                    case 'cancelado':
                        color = 'red';
                        break;
                    default:
                        color = 'black';
                }

                $(this).css('color', color);
            });

            // Inicializar a cor do texto do dropdown no carregamento
            $('select[name="status"]').each(function() {
                $(this).change(); // Chama a função de mudança de cor no carregamento
            });
        });
    </script>
</x-app-layout>