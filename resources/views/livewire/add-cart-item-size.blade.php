<div x-data>
    <div>
        <p class="text-xl text-gray-700">Talla:</p>

        <select wire:model="size_id" class="form-control w-full">
            <option value="" selected disabled>Seleccione una talla</option>
            @foreach ($sizes as $size)
                <option value="{{ $size->id }}">{{ $size->name }}</option>

            @endforeach
        </select>
    </div>

    <div class="mt-2">
        <p class="text-xl text-gray-700">COLOR:</p>

        <select wire:model="color_id" class="form-control w-full">
            <option value="" selected disabled>Seleccione una color</option>
            @foreach ($colors as $color)
                <option class="capitalize" value="{{ $color->id }}">{{ $color->name }}</option>

            @endforeach
        </select>
    </div>
    <p class="text-gray-700 my-4">
        <span class="font-semibold text-lg">Stock disponible:</span>

        @if ($quantity)
            {{$quantity}}
        @else
            {{$product->stock}}
        @endif

    </p>
    <div class="flex mt-4">
        <div class="mr-4">
            <x-jet-secondary-button 
                disabled x-bind:disabled="$wire.qty <= 1" 
                wire:loading.attr="disabled"
                wire:tarjet="decrement" 
                wire:click="decrement">
                -
            </x-jet-secondary-button>

            <span class="mx-2 text-gray-700">{{ $qty }}</span>

            <x-jet-secondary-button 
                x-bind:disabled="$wire.qty >= $wire.quantity" 
                wire:loading.attr="disabled"
                wire:tarjet="increment" 
                wire:click="increment">
                +
            </x-jet-secondary-button>
        </div>
        <div class="flex-1">
            <x-button x-bind:disabled="!$wire.quantity" 
            x-bind:disabled="$wire.qty > $wire.quantity" 
            color="orange" 
            class="w-full"
            wire:click="addItem"
            wire:loading.attr="disabled"
            wire:target="addItem">
                AGREGAR A CARRITO DE COMPRAS
            </x-button>
        </div>
    </div>
</div>
