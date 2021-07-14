<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DropdownCart extends Component
{
    /* escuchar un evento */
    protected $listeners = ['render'];
    public function render()
    {
        return view('livewire.dropdown-cart');
    }
}
