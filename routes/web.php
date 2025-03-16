<?php

use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ErrorItemController;
Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\ProductController;

Route::resource('products', ProductController::class);
Route::resource('error-items', ErrorItemController::class);
Route::get('/dashboard', [ProductController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/', [ProductController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/dashboard', function () {
// $products = Product::all();

//     return view('dashboard',compact('products'));
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/products/{id}/print', [ProductController::class, 'showProductForPrint'])->name('products.print');
Route::patch('/products/{id}/update-status', [ProductController::class, 'updateStatus'])->name('products.updateStatus');



require __DIR__.'/auth.php';
