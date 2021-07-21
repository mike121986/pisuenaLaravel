<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter extends Component
{
    use WithPagination;
    public  $category;
    /* estas dos propiedades las usaremos para que se guarden los valores cuando se haga clic en los filtros */
    public  $subcategoria;
    public  $marca;

    public $view = "grid";

    /* creamos un metodo para limpiar dos valores,  */
    public function limpiar(){
        $this->reset(['subcategoria','marca']);
    }
    public function render()
    {
        $productsQuery = Product::query()->whereHas('subcategory.category', function(Builder $query){
            $query->where('id',$this->category->id);
        });

        if ($this->subcategoria) {
            $productsQuery = $productsQuery->whereHas('subcategory', function(Builder $query){
                $query->where('name',$this->subcategoria);
            });
    
        }

        if($this->marca){
            /* $productsQuery = $productsQuery->whereHas('brands', function(Builder $query){
                $query->where('name',$this->marca); */

                $productsQuery = $productsQuery->whereHas('brand', function(Builder $query){
                    $query->where('name', $this->marca);
                });
        }
        

        $products = $productsQuery->paginate(20);
     /*    $products=$this->category->products()->where('status',2)->paginate(20); */
        return view('livewire.category-filter',compact('products'));
    }
}
