<x-layout titulo="Editar cliente">
    <div class="container mx-auto">
        <form method="post" action="{{ route('clientes.update', $cliente) }}" class="max-w-6xl mx-auto">
            @method('PUT')
            @include('clientes._form', ['nome' => 'Editar cliente'])
        </form>
    </div>  
</x-layout>