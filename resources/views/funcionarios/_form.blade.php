@csrf
<fieldset class="border rouded-lg p-4 mb-4">
    <legend class="font-bold">Dados Básicos</legend>
    <x-input nome="nome" labelTitulo="Nome do Funcionario" :valorPadrao="$funcionario->nome ?? ''" />

    <x-input nome="cpf" labelTitulo="CPF do Funcionario" :valorPadrao="$funcionario->cpf ?? ''" />

    <x-input nome="data_contratacao" labelTitulo="Data de contratação do funcionario" :valorPadrao="$funcionario->data_contratacao ?? ''" />
</fieldset>

<fieldset class="border rouded-lg p-4 mb-4">
    <legend class="font-bold">Endereço</legend>
    <x-input nome="logradouro" labelTitulo="Logradouro" :valorPadrao="$funcionario->address->logradouro ?? ''" />
    <x-input nome="numero" labelTitulo="Número" :valorPadrao="$funcionario->address->numero ?? ''" />
    <x-input nome="bairro" labelTitulo="Bairro" :valorPadrao="$funcionario->address->bairro ?? ''" />
    <x-input nome="cidade" labelTitulo="Cidade" :valorPadrao="$funcionario->address->cidade ?? ''" />
    <x-input nome="cep" labelTitulo="Cep" :valorPadrao="$funcionario->address->cep ?? ''" />
    <x-input nome="estado" labelTitulo="Estado" :valorPadrao="$funcionario->address->estado ?? ''" />
    <x-input nome="complemento" labelTitulo="Complemento" :valorPadrao="$funcionario->address->logradouro ?? ''" />
</fieldset>

<x-botao-primario titulo="Editar Funcionario" />

@push('scripts')
<script src="https://unpkg.com/imask"></script>
<script>
    IMask(document.getElementById('cpf'), {mask:'000.000.000-00'});
    IMask(document.getElementById('data_contratacao'), {mask:'00/00/0000'});
    IMask(document.getElementById('cep'), {mask:'00.000-000'});
</script>
@endpush