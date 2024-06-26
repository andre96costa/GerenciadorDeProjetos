<x-layout titulo="Lista de Funcionarios">
    <div class="flex justify-end my-3">
        <a class="bg-green-500 border rounded-md p-1 px-3 text-white" href="/funcionarios/create">Criar funcionario</a>
    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nome
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cpf
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Descrição
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($funcionarios as $funcionario)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $funcionario->nome }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $funcionario->cpf }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $funcionario->address->enderecoCompleto }}
                        </td>
                        <td class="px-6 py-4">
                            <a class="bg-blue-500 border rounded-md p-1 px-3 text-white" href="{{ route('funcionarios.edit', $funcionario) }}">Editar</a>
                            <form class="inline-block" action="{{ route('funcionarios.destroy', $funcionario->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 border rounded-md p-1 px-3 text-white" onclick="return confirm('Deseja excluir esse funcionario?');">Excluir</button>
                            </form>

                            <form class="inline-block" action="{{ route('funcionarios.demitir', $funcionario->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="bg-pink-500 border rounded-md p-1 px-3 text-white disabled:bg-gray-300" onclick="return confirm('Deseja demitir esse funcionario?')"
                                {{ $funcionario->data_demissao ? 'disabled' : '' }}
                                >Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td></td>
                        <td></td>
                        <th>
                            Nenhum funcionario cadastrado
                        </th>
                        <td></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="my-4">
            {{ $funcionarios->links() }}
        </div>
    </div>
</x-layout>
