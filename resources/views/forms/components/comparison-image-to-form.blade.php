<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-3 md:grid-cols-6 lg:grid-cols-8 gap-4">
                <div class="image-container">
                    <img src="{{ $getRecord()->imagem }}" class="">
                </div>
            </div>
        </div>
        <hr>
        <br>
    </div>
</x-dynamic-component>
