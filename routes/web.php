<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Livewire\ShopingCart;
use App\Http\Livewire\CreateOrder;
use App\Http\Controllers\WebHookcsController;
use App\Http\Livewire\PaymentOrder;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', WelcomeController::class);
Route::get('search',SearchController::class)->name('search');

Route::get('categories/{category}',[CategoryController::class, 'show'])->name('categories.show');

Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('shoping-cart',ShopingCart::class)->name('shoping-cart');


/* grupo de rutas */
Route::middleware(['auth'])->group(function(){
        
    // ruta para ordenes
    Route::get('orders/create', CreateOrder::class)->name('orders.create');

    // ruta para pagar
    Route::get('orders/{order}', [OrderController::class,'show'])->name('orders.show');

    /* Route::get('orders/{order}/payment', [OrderController::class,'payment'])->name('orders.payment'); */
    Route::get('orders/{order}/payment', PaymentOrder::class)->name('orders.payment');


    // ruta para la webhoock
    Route::post('webhoocks',WebHookcsController::class);

    /* ruta para mostrar la notificacion mientras estamos en pruebas */
    Route::get('orders/{order}/pay', [OrderController::class,'pay'])->name('orders.pay');

    /* rutas para ver mis pedidos */
    Route::get('orders',[OrderController::class,'index'])->name('orders.index');
});