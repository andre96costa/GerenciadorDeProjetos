<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <x-menu />

    <div class="container mx-auto">
        <h1 class="text-4xl font-bold text-center my-4">
            {{ $titulo }}
        </h1>
        @if (session('sucesso'))
            <div class="p-2 bg-green-500 text-white border-2 border-green-500 rounded-sm text-center">
                {{ session('sucesso') }}
            </div>
        @endif
        {{ $slot }}
    </div>

    @stack('scripts')
    
</body>

</html>
