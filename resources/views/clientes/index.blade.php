<x-layout titulo="Lista de Clientes">
    <div class="flex justify-end my-3">
        <a class="bg-green-500 border rounded-md p-1 px-3 text-white" href="/clientes/create">Criar cliente</a>
    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nome
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Endereço
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Descrição
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Projetos
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $cliente->nome }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $cliente->endereco }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $cliente->descricao }}
                        </td>
                        <td class="px-6 py-4">
                            @forelse ($cliente->projects as $projeto)
                                @if ($loop->last)
                                    {{ $projeto->nome }}
                                @else
                                    {{ $projeto->nome }}{{ ', ' }}
                                @endif
                            @empty
                                Nenhum projeto
                            @endforelse
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
