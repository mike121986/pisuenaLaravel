<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItemColor extends Component
{
    public $product;
    public $color;
    public $color_id = "";

    public $quantity = 0;
    public $qty = 1;

    public $options = [
        'size_id' => null
    ];

    public function mount()
    {
        //$this->color = $this->product->colors;
        $this->color = $this->product->colors;
        $this->options['image'] = Storage::url($this->product->images->first()->url);
    }

    public function updatedColorId($value)
    {
        $color = $this->product->colors->find($value);
        // $this->quantity = $color->pivot->quantity;
        $this->quantity = qty_avilable($this->product->id, $color->id);
        $this->options['color'] = $color->name;
        
    }

    public function decrement()
    {
        $this->qty = $this->qty - 1;
    }

    public function increment()
    {
        $this->qty = $this->qty + 1;
    }

    public function addItem()
    {
        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'price' => $this->product->price,
            'weight' => 550,
            'options' => $this->options
        ]);
        $this->quantity = qty_avilable($this->product->id, $this->color_id);
      /*   dd( $this->quantity); */
        // resetar el valor de qty para que muestre un cero una vez que hallamos agregado al carrito
        $this->reset('qty');

        $this->emitTo('dropdown-cart', 'render');
    }
    public function render()
    {
        return view('livewire.add-cart-item-color');
    }
}
