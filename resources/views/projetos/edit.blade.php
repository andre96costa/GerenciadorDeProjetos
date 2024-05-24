<x-layout titulo="Editar Projeto">
    <div class="container mx-auto">
        <form method="post" action="{{ route('projetos.update', $projeto) }}" class="max-w-6xl mx-auto">
            @method('PUT')
            @include('projetos._form', ['nome' => 'Editar projeto'])
        </form>
    </div>
</x-layout>
