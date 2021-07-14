<?php

use App\Models\Product;
use App\Models\Size;
use Gloudemans\Shoppingcart\Facades\Cart;

// calcular cantidad de cualquier producto
function quantity($product_id, $color_id = null, $size_id = null)
{
    $product = Product::find($product_id);

    if ($size_id) {
        $size = Size::find($size_id);
        $quantity =  $size->colors->find($color_id)->pivot->quantity;
    } elseif ($color_id) {
        $quantity =  $product->colors->find($color_id)->pivot->quantity;
    } else {
        $quantity = $product->quantity;
    }

    return  $quantity;
}
// calcula la cantidad de items que se han agregado
function qty_added($product_id, $color_id = null, $size_id = null){
    $cart = Cart::content();

    $item = $cart->where('id',$product_id)
                 ->where('option.color_id',$color_id)
                 ->where('option.size_id',$size_id)
                 ->first();
    if($item){
        return $item->qty;
    }else{
        return 0;
    }
}

// calcula la resta de lo items agregados contra el stock en existecia
function qty_avilable($product_id, $color_id = null, $size_id = null){
    return quantity($product_id, $color_id, $size_id) - qty_added($product_id, $color_id, $size_id);
}


