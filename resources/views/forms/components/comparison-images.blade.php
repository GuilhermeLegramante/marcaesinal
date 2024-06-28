<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div wire:loading.remove x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">

        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($this->images as $item)
                    <div class="image-container flex flex-col items-center">
                        <div wire:click="showDetails('{{ $item }}')" class="cursor-pointer">
                            <img src="{{ $item }}" class="w-full h-auto">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <hr>
        <br>

        <div class="flex justify-center">
            <p class="fi-section-header-description text-sm text-gray-500 dark:text-gray-400">
                <x-filament::button wire:click="loadLess()">
                    Ver menos
                </x-filament::button>
                <x-filament::button wire:click="loadMore()">
                    Ver mais
                </x-filament::button>
            </p>
        </div>
    </div>

    <div wire:loading class="flex justify-center items-center h-full">
        <x-filament::loading-indicator class="h-5 w-5" />
    </div>

    <x-filament::modal id="brand-details" width="md">
        <x-slot name="heading">
            Detalhes da Marca
        </x-slot>


        <div class="flex justify-center items-center h-full">
            <img src="{{ isset($this->brand['path']) ? $this->brand['path'] : '' }}" class="max-w-full h-auto">
        </div>

        <div class="flex justify-center w-full">
            <strong>
                {{ isset($this->brand['number']) ? $this->brand['number'] : '' }} /
                {{ isset($this->brand['year']) ? $this->brand['year'] : '' }} -
                {{ isset($this->brand['farmer_name']) ? $this->brand['farmer_name'] : '' }}
            </strong>
        </div>
        <div class="flex justify-center w-full">
            <strong>
                {{ isset($this->brand['farmer_phone']) ? $this->brand['farmer_phone'] : '' }}
            </strong>
        </div>
        <div class="flex justify-center w-full">
            <strong>
                {{ isset($this->brand['client_name']) ? $this->brand['client_name'] : '' }}
            </strong>
        </div>
    </x-filament::modal>
</x-dynamic-component>

<style>
    .image-container {
        position: relative;
        padding-bottom: 25%;
        /* 4:3 Aspect Ratio */
        overflow: hidden;
    }

    .image-container img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
</style>
