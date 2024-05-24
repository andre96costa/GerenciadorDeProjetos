@csrf
<x-input nome="nome" labelTitulo="Nome do projeto" :valorPadrao="$projeto->nome ?? ''" />

<x-input nome="orcamento" labelTitulo="Orçamento" :valorPadrao="$projeto->orcamento ?? ''" />

<x-input nome="data_inicio" labelTitulo="Data de inicio" :valorPadrao="$projeto->data_inicio ?? ''" />

<x-input nome="data_final" labelTitulo="Data final" :valorPadrao="$projeto->data_final ?? ''" />

<select name="client_id" class="my-10 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
    @foreach ($clientes as $cliente)
        <option value="{{ $cliente->id }}" {{isset($projeto->client->id) && $projeto->client->id == $cliente->id ? 'selected' : ''}}>{{ $cliente->nome }}</option>
    @endforeach
</select>

<x-multiple
    nome="funcionarios"
    labelTitulo="Funcionários que trabalham no projeto"
    itemID="id"
    itemDescricao="nome"
    :lista="$funcionarios"
    :valorPadrao="isset($projeto) ? $projeto->employees->pluck('id')->toArray() : []"
/>

<x-botao-primario titulo="{{ $nome }}" />

@push('scripts')
<script src="https://unpkg.com/imask"></script>
<script>
    IMask(document.getElementById('data_inicio'), {mask:'00/00/0000'});
    IMask(document.getElementById('data_final'), {mask:'00/00/0000'});
    IMask(document.getElementById('orcamento'), {
        mask: Number,
        scale: 2,
        thousandsSeparator: '.',
        padFractionalZeros: true,
        normalizeZeros: true,
        radix: ',',
        mapToRadix: ['.'],
        min: 1,
        autofix: true
    });
</script>
@endpush
