<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Http\Controllers\CategoryController;

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

Route::get('/', function () {
    $filtering_group_1_products = [1,2,3];

    return view('index-2', [
        'filtering_group_1_products' => $filtering_group_1_products
    ]);
})->name('index-2');

Route::get('/wishlist', function () {
    return view('wishlist');
})->name('wishlist');

Route::view('/cart', 'cart')->name('cart.index');
Route::view('/checkout', 'checkout')->name('checkout');
Route::view('/contacts', 'contact-us')->name('contacts');
Route::view('/account', 'account')->name('account');

Route::resource('category', CategoryController::class);
Route::redirect('/catalog', route('category.index'));

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::fallback(fn() => view('404'));

require __DIR__.'/auth.php';
