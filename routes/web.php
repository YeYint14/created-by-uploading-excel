<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\ProductController;

Route::group(['middleware' => ['web']], function () {
    Route::get('/', [ProductController::class, 'uploadForm'])->name('products.uploadForm');
    Route::post('/products/upload', [ProductController::class, 'import'])->name('products.import');
    Route::get('/products/table', [ProductController::class, 'getProductTable'])->name('products.table');
    Route::delete('/products/delete-selected', [ProductController::class, 'deleteSelected'])->name('products.deleteSelected');
});




