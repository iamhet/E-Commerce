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


Route::controller(ClientController::class)->group(function () {
    Route::get('index', 'index');
});
Route::controller(AdminController::class)->group(function () {
    Route::get('/', 'login')->name('admin.login');
    Route::get('admin/register', 'register')->name('admin.register');
    Route::post('register', 'admin_registration')->name('admin.admin_registration');
    Route::get('admin/index', 'index')->name('admin.index');
});
Route::controller(ProfileController::class)->group(function () {
    Route::get('admin/profile', 'index')->name('profile.index');
});
