<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CategoryProducts extends Component
{
    public $category;
    public $products = [];

    public function loadPost(){
        $this->products = $this->category->products;

        /* emitir metodos de livewre */
        $this->emit('glider',$this->category->id);
    }
    public function render()
    {
        return view('livewire.category-products');
    }
}
