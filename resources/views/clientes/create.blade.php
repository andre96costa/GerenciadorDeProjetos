<x-layout titulo="Cadastrar novo cliente">

    <div class="container mx-auto">
        <form method="post" action="/clientes" class="max-w-6xl mx-auto">
           @include('clientes._form', ['nome' => 'Salvar cliente'])
        </form>
    </div>  
</x-layout>
