<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class CategoryFilter extends Component
{
    use WithPagination;
    public  $category;
    /* estas dos propiedades las usaremos para que se guarden los valores cuando se haga clic en los filtros */
    public  $subcategoria;
    public  $marca;

    public function render()
    {
        $products=$this->category->products()->where('status',2)->paginate(20);
        return view('livewire.category-filter',compact('products'));
    }
}
