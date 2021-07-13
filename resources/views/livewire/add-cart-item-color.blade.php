<div x-data>
    <p class="text-xl text-gray-700">Color:</p>
    <select wire:model="color_id" class="form-control w-full">
        <option value="" selected disabled>Selecionar un color</option>
        @foreach ($color as $colors)
            <option value="{{ $colors->id }}">{{ $colors->name }}</option>
        @endforeach
    </select>

    <div class="flex mt-4">
        <div class="mr-4">
            <x-jet-secondary-button disabled x-bind:disabled="$wire.qty <= 1" wire:loading.attr="disabled"
                wire:tarjet="decrement" wire:click="decrement">
                -
            </x-jet-secondary-button>
            <span class="mx-2 text-gray-700">{{ $qty }}</span>
            <x-jet-secondary-button x-bind:disabled="$wire.qty >= $wire.quantity" wire:loading.attr="disabled"
                wire:tarjet="increment" wire:click="increment">
                +
            </x-jet-secondary-button>
        </div>
        <div class="flex-1">
            <x-button x-bind:disabled="!$wire.quantity" color="orange" class="w-full">
                AGREGAR A CARRITO DE COMPRAS
            </x-button>
        </div>
    </div>
</div>
