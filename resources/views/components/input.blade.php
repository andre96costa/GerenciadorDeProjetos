<div class="mb-5">
    <x-label for="{{ $nome }}" titulo="{{ $labelTitulo }}" />
     <input type="text" id="{{ $nome }}" name="{{ $nome }}" value="{{ old($nome, $valorPadrao ?? '') }}"
         class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
    @if ($errors->get($nome))
        <ul class="">
            @foreach ($errors->get($nome) as $error)
                <li class="text-sm text-left mb-3 font-semibold text-red-600">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</div>