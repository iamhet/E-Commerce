<?php

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

use Illuminate\Support\Facades\Route;
use Modules\Products\Http\Controllers\ProductsController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::controller(ProductsController::class)->group(function () {
        Route::match(['get', 'post'],'/productindex', 'index')->name('admin.productindex');
        Route::match(['get', 'post'],'/addProduct', 'addProduct')->name('admin.addProduct');
        Route::match(['get', 'post'],'/saveProduct', 'saveProduct')->name('admin.saveProduct');
        Route::match(['get', 'post'],'/saveProductImages', 'saveProductImages')->name('admin.saveProductImages');
        Route::get('/viewProducts', 'viewProducts')->name('admin.viewProducts');
        Route::get('/viewProductsDatatable', 'productDatatable')->name('admin.viewProductsDatatable');
    });
});
