<x-layout titulo="Editar Funcionario">
    <div class="container mx-auto">
        <form method="post" action="{{ route('funcionarios.update', $funcionario) }}" class="max-w-6xl mx-auto">
            @method('PUT')
            @include('funcionarios._form')
        </form>
    </div>  
</x-layout>