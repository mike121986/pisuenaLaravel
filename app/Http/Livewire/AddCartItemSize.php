<?php

namespace App\Http\Livewire;

use App\Models\Size;
use Livewire\Component;

class AddCartItemSize extends Component
{

    public $product;
    public $sizes;
    public $size_id = "";
    public $colors = [];

    public $color_id = "";
    public $quantity = 0;
    public $qty = 1;
    /* ESTA FUNCION ESTA A LA ESPERA DE LO QUE PASE CUANDO SE SELCCIONA UNA TALLA */
    public function updatedSizeId($value){
        $size = Size::find($value);
        $this->colors = $size->colors;
    }

    public function mount(){
        $this->sizes = $this->product->sizes;
    }
    public function render()
    {
        return view('livewire.add-cart-item-size');
    }

    public function updatedColorId($value)
    {
        $size = Size::find($this->size_id);
        $this->quantity = $size->colors->find($value)->pivot->quantity;
    }

    public function decrement()
    {
        $this->qty = $this->qty - 1;
    }
    public function increment()
    {
        $this->qty = $this->qty + 1;
    }
}
