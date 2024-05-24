<x-layout titulo="Lista de Projetos">
    <div class="flex justify-end my-3">
        <a class="bg-green-500 border rounded-md p-1 px-3 text-white" href="{{ route('projetos.create') }}">Criar Projetos</a>
    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nome
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Orçamento
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Data inicio
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Data fim
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cliente
                    </th>
                    <th>
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projetos as $projeto)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $projeto->nome }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $projeto->orcamento }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $projeto->data_inicio }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $projeto->data_final }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($projeto->client)
                                {{ $projeto->client->nome }}
                            @else
                                Nenhum cliente
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a class="bg-blue-500 border rounded-md p-1 px-3 text-white" href="{{ route('projetos.edit', $projeto) }}">Editar</a>
                            <form class="inline-block" action="{{ route('projetos.destroy', $projeto) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 border rounded-md p-1 px-3 text-white" onclick="return confirm('Deseja excluir esse projeto?');">Excluir</button>
                            </form>
                            <a class="bg-pink-500 border rounded-md p-1 px-3 text-white" href="{{ route('projetos.show', $projeto) }}">Visualizar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td></td>
                        <td></td>
                        <th>
                            Nenhum cliente cadastrado
                        </th>
                        <td></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="my-4">
            {{ $projetos->links() }}
        </div>
    </div>
</x-layout>
