<x-layout titulo="Cadastrar novo Funcionário">

    <div class="container mx-auto">
        <form method="post" action="{{ route('funcionarios.store') }}" class="max-w-6xl mx-auto">
           @include('funcionarios._form', ['nome' => 'Salvar cliente'])
        </form>
    </div>  
</x-layout>
