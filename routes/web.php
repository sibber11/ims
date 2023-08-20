<?php

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;

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
    return view('welcome');
})->name('index');



Route::get('/dashboard', function () {
    return Inertia::render('HomeView');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('category', \App\Http\Controllers\CategoryController::class);
    Route::resource('brand', \App\Http\Controllers\BrandController::class);
    Route::resource('product', \App\Http\Controllers\ProductController::class);
    Route::resource('order', \App\Http\Controllers\OrderController::class);
    Route::resource('item', \App\Http\Controllers\ItemController::class);
    Route::resource('sales', \App\Http\Controllers\SaleController::class);

    Route::delete('order/delete-all', [\App\Http\Controllers\OrderController::class, 'deleteAll'])->name('order.delete_all');
    Route::resource('customers', \App\Http\Controllers\CustomerController::class);
    Route::get('suppliers', function (\Illuminate\Http\Request $request){

        return ['data'=>User::role('supplier')->limit(10)->get()];
    })->name('suppliers.index');
    Route::get('brands', function (\Illuminate\Http\Request $request){

        return ['data'=>\App\Models\Brand::limit(10)->get()];
    })->name('brands.index');
    Route::get('products', function (\Illuminate\Http\Request $request){
        return ['data'=>\App\Models\Product::with('availableItem')->limit(10)->get()];
    })->name('products.index');

});

require __DIR__.'/auth.php';
