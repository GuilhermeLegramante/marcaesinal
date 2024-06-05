<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">

    <body class="flex items-center justify-center min-h-screen bg-gray-100" x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">

        <div class="w-full h-8 bg-cover bg-center bg-no-repeat"
            style="background-image: url({{ asset('/img/cow-head.png') }}); height: 20rem; background-repeat: no-repeat;">
            <!-- Conteúdo da div -->
            <div class="flex items-center justify-center h-full bg-black bg-opacity-50 text-white">
                <h1 class="text-2xl">teste</h1>
            </div>
        </div>
    </body>
</x-dynamic-component>
