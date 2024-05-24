<x-layout titulo="Criar novo projeto">

    <div class="container mx-auto">
        <form method="post" action="{{ route('projetos.store') }}" class="max-w-6xl mx-auto">
           @include('projetos._form', ['nome' => 'Criar Projeto'])
        </form>
    </div>
</x-layout>
