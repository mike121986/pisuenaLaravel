<?php

namespace App\Http\Livewire;

use App\Models\Color;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class UpdateCartItemColor extends Component
{
    public $rowId;
    public $qty;
    public $quantity;

    public function mount()
    {
        $item = Cart::get($this->rowId);
        $this->qty = $item->qty;

        $color = Color::where('name', $item->options->color)->first();
        $this->quantity = qty_avilable($item->id, $color->id);
    }

    public function decrement()
    {
        $this->qty = $this->qty - 1;

        Cart::update($this->rowId, $this->qty);
        $this->emit('render');
    }
    public function increment()
    {
        $this->qty = $this->qty + 1;

        Cart::update($this->rowId, $this->qty);
        $this->emit('render');
    }
    public function updatedColorId($value)
    {
        $color = $this->product->colors->find($value);
        // $this->quantity = $color->pivot->quantity;
        $this->quantity = qty_avilable($this->product->id, $color->id);
        $this->options['color'] = $color->name;
    }

    public function render()
    {
        return view('livewire.update-cart-item-color');
    }
}
