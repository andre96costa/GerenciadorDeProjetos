@csrf
<x-input nome="nome" labelTitulo="Nome do cliente" :valorPadrao="$cliente->nome ?? ''" />

<x-input nome="endereco" labelTitulo="Endereço do cliente" :valorPadrao="$cliente->endereco ?? ''" />

<x-input nome="descricao" labelTitulo="Descrição do cliente" :valorPadrao="$cliente->descricao ?? ''" />

<x-botao-primario titulo="{{ $nome }}" />