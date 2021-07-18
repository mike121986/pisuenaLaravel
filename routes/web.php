<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Livewire\ShopingCart;
use App\Http\Livewire\CreateOrder;
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

// ruta para ordenes
Route::get('orders/create', CreateOrder::class)->middleware('auth')->name('orders.create');
// ruta para pagar
Route::get('orders/{order}/payment', [OrderController::class,'payment'])->name('orders.payment');
