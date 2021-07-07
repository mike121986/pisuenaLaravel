<?php

namespace App\Http\Livewire;

use Livewire\Component;
// importamos el modelo category
use App\Models\Category;
class Navigation extends Component
{
    public function render()
    {
        $categories = Category::all();

        return view('livewire.navigation',compact('categories'));
    }
}
