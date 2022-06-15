<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', function() { return view('auth.login'); });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index.index');
    })->name('dashboard');
});
Route::controller(ClientController::class)->group(function () {
    Route::get('index', 'index');
});
Route::controller(AdminController::class)->group(function () {
    Route::post('layout_setting_data', 'get_layout_setting')->name('layout_setting_data');
    Route::post('set_layout_setting','set_layout_setting')->name('set_layout_setting');
});
