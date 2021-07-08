<x-app-layout>
    <div class="container py-8">
        <figure class="mb-4">
            <img class="w-full h-80 object-cover object-center" src="{{Storage::url($category->image)}}" alt="">
        </figure>
        {{-- incluimos al componente livewire de filtros --}}
        @livewire('category-filter', ['category' => $category])
    </div>
</x-app-layout>