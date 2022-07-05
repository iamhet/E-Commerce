<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\ClientController;
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
    Route::get('/index', 'index');
});
Route::controller(AdminController::class)->group(function () {
    Route::post('/layout_setting_data', 'get_layout_setting')->name('layout_setting_data');
    Route::post('/set_layout_setting','set_layout_setting')->name('set_layout_setting');
    Route::get('/reset_layout_setting','reset_layout_setting')->name('reset_layout_setting');
});

Route::controller(SettingController::class)->group(function () {
    Route::get('/settings','settings')->name('admin.settings');
    Route::post('/save_settings','save_general_settings')->name('admin.save_settings');
    Route::post('/remove_settings','remove_general_settings')->name('admin.remove_settings');
    Route::get('/company_information','company_information')->name('admin.company_information');
    Route::post('/save_company_information','save_settings_information')->name('admin.save_settings_information');
    Route::get('/email','email')->name('admin.email');
});
