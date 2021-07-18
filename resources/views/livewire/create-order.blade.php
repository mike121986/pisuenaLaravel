<div class="container py-8 grid grid-cols-5 gap-6">
    <div class="col-span-3">
        <div class="bg-white rounded-lg shadow p-6">
            {{-- nombre de contacto --}}
            <div class="mb-4">
                <x-jet-label value="Nombre de contacto" />
                <x-jet-input type="text" 
                             wire:model.defer="contact"
                             placeholder="ingrese el nombre de la persona que recibira el producto" 
                             class="w-full" />
                <x-jet-input-error for="contact"/>
            </div>
            {{-- telefono de contacto --}}
            <div>
                <x-jet-label value="Telefono de contacto" />
                <x-jet-input type="text" 
                             wire:model.defer="phone"
                             placeholder="ingrese un numero de contacto" 
                             class="w-full" />
                <x-jet-input-error for="phone"/>
            </div>
        </div>
        <div x-data="{envio_type:@entangle('envio_type')}">
            <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold">Envíos</p>
            <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4">
                <input x-model="envio_type" type="radio" name="envio_type" value="1" class="text-gray-600">
                <span class="ml-2 text-gray-700">recogo en tienda (calle falsa 123)</span>
                <span class="font-semibold text-gray-700 ml-auto">GRATIS</span>
            </label>
            <div class="bg-white rounded-lg shadow">
                <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center">
                    <input x-model="envio_type" type="radio" name="envio_type" value="2" class="text-gray-600">
                    <span class="ml-2 text-gray-700">Envío a domicilio</span>
                </label>
                <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden':envio_type!=2}">
                    {{-- departmaentos --}}
                    <div>
                        <x-jet-label value="Municipio" />
                        <select class="form-control w-full" wire:model='department_id'>
                            <option value="" disabled selected>Seleccione un departamento</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="department_id"/>
                    </div>
                    {{-- ciudades --}}
                    <div>
                        <x-jet-label value="Estado" />
                        <select class="form-control w-full" wire:model='city_id'>
                            <option value="" disabled selected>Seleccione una ciudad</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="city_id"/>
                    </div>
                    {{-- distritos --}}
                    <div>
                        <x-jet-label value="Ciudad" />
                        <select class="form-control w-full" wire:model='district_id'>
                            <option value="" disabled selected>Seleccione una ciudad</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="district_id"/>
                    </div>
                    {{-- direccion --}}
                    <div>
                        <x-jet-label value="Dirección" />
                        <x-jet-input class="w-full" type="text" wire:model="addres"/>
                        <x-jet-input-error for="addres" />
                    </div>
                    {{-- referencia --}}
                    <div class="col-span-2">
                        <x-jet-label value="Referencia" />
                        <x-jet-input class="w-full" wire:model="references" type="text" />
                        <x-jet-input-error for="references" />
                    </div>
                </div>
            </div>
        </div>
        <div>
            <x-jet-button 
                        wire:loading.attr="disabled"
                        wire:tarjet="create_order"
                        class="mt-6 mb-4" 
                        wire:click="create_order">
                Continúa con la compra
            </x-jet-button>

            <hr>
            <p class="text-sm text-gray-700 mt-2">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quam,
                officia veritatis numquam iusto ab incidunt. Earum, totam. Reprehenderit, adipisci odit porro, deserunt
                nemo neque, amet aliquid dolor saepe consequatur quia? <a class="font-semibold text-orange-500"
                    href="http://">POLÍTICAS Y PRIVACIDAD</a></p>
        </div>
    </div>
    <div class="col-span-2">
        <div class="bg-white rounded-lg shadow">
            <ul>
                @forelse (Cart::content() as $item)
                    <li class="flex p-3 border-b border-gray-200">
                        <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}" alt="">
                        <article class="flex-1">
                            <h1 class="font-bold"> {{ $item->name }} </h1>
                            <div class="flex">
                                <p>Cant: {{ $item->qty }}</p>
                                @isset($item->options['color'])
                                    <p class="mx-2">
                                        -Color:{{ $item->options['color'] }}
                                    </p>
                                @endisset

                                @isset($item->options['size'])
                                    <p>
                                        -Talla:{{ $item->options['size'] }}
                                    </p>
                                @endisset

                            </div>
                            <p>Mx: {{ $item->price }}</p>
                        </article>
                    </li>
                @empty
                    <li class="py-6 px-4">
                        <p class="text-center text-gray-700">
                            No Tiene agregado nungún item en el carrito
                        </p>
                    </li>

                @endforelse
            </ul>
            <hr class="mt-4 mb-3">
            <div class="tex-gray-700">
                <p class="flex justify-between items-center">
                    Subtotal
                    <span class="font-semibold">{{ Cart::subtotal() }} MXN</span>
                </p>
                <p class="flex justify-between items-center">
                    Envío
                    <span class="font-semibold">
                        @if ($envio_type == 1 || $shipping_cost == 0)
                            GRATIS
                        @else
                            {{$shipping_cost}} MXN
                        @endif
                    </span>
                </p>
                <hr class="mt-4 mb-3">
                <p class="flex justify-between items-center font-semibold">
                    <span class="text-lg">Total</span>
                    @if ($envio_type == 1 || $shipping_cost == 0)                    
                    {{ Cart::subtotal() }} MXN
                    @else
                    {{ Cart::subtotal()+$shipping_cost }} MXN                        
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
