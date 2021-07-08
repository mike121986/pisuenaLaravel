<x-app-layout>
    <div class="container py-8">
        <section>
            <h1 class="text-lg uppercase font-semibold text-gray-700">
                {{$categories->first()->name}}
            </h1>
            @livewire('category-products', ['category' => $categories->first()])
        </section>
    </div>
</x-app-layout>