<x-app-layout>
    <div class="container py-8">
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
            <p class="text-gray-700 uppercase">
                <span class="font-semibold">Número de orden:</span> Orden-{{ $order->id }}
            </p>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="grid grid-cols-2 gap-6 text-gray-700">
                {{-- aqui se muestra a donde seran entregado los productos --}}
                <div>
                    <p class="text-lg font-semibold uppercase">Envío</p>
                    @if ($order->envio_type == 1)
                        <p class="text-sm">Los Productos deben ser recogidon en tienda</p>
                        <p class="text-sm">Calle 123</p>
                    @else
                        <p class="text-sm">Los Productos seran enviado a:</p>
                        <p class="text-sm">{{ $order->addres }}</p>
                        <p>{{ $order->department->name }} - {{ $order->city->name }} -
                            {{ $order->district->name }}</p>
                    @endif
                </div>
                {{-- aqui se mustra los datos de la persona que recibira los productos --}}
                <div>
                    <p class="text-lg font-semibold uppercase">Datod de contacto</p>
                    <p class="text-sm">Persona que recibirá el producto: <span class="font-semibold uppercase">
                            {{ $order->contact }}</span></p>
                    <p class="text-sm">Telpéfono de contacto: <span
                            class="font-semibold uppercase">{{ $order->phone }}</span></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 mb-6">
            <p class="text-xl font-semibold mb-4">Resumen</p>
            <table class="table-auto w-full">
                <thead>
                    <th></th>
                    <th>Precio</th>
                    <th>Cant</th>
                    <th>Total</th>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                <div class="flex">
                                    <img class="h-15 w-20 object-cover mr-4 " src="{{ $item->options->image }}" alt=""
                                        srcset="">
                                    <article>
                                        <h1 class="font-bold">{{ $item->name }}</h1>
                                        <div class="flex text-xs">
                                            @isset($item->options->color)
                                                Color: {{ $item->options->color }}
                                            @endisset
                                            @isset($item->options->size)
                                                -{{ $item->options->size }}
                                            @endisset
                                        </div>
                                    </article>
                                </div>
                            </td>
                            <td class="text-center">
                                {{ $item->price }} MXN
                            </td>
                            <td class="text-center">
                                {{ $item->qty }}
                            </td>
                            <td class="text-center">
                                {{ $item->price * $item->qty }} MXN
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 flex justify-between items-center">
            <img class="h-8" src="{{asset('img/MC_VI_DI_2-1.jpg')}}" alt="">
            <div class="text-gray-700">
                <p class="text-sm font-semibold ">
                    Subtotal: {{$order->total - $order->shipping_cost}} MXN
                </p>
                <p class="text-sm font-semibold ">
                    Envío: {{$order->shipping_cost}} MXN
                </p>
                <p class="text-lg font-semibold uppercase">
                    Pago: {{$order->total}} MXN
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
