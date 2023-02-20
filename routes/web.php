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


Route::controller(ClientController::class)->group(function () {
    Route::get('/', 'index');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/admin', function () {
        return view('auth.login');
    });

    Route::get('/dashboard', function () {
        return view('admin.index.index');
    })->name('dashboard');

    Route::controller(AdminController::class)->group(function () {
        Route::post('/layout_setting_data', 'get_layout_setting')->name('layout_setting_data');
        Route::post('/set_layout_setting', 'set_layout_setting')->name('set_layout_setting');
        Route::get('/reset_layout_setting', 'reset_layout_setting')->name('reset_layout_setting');
    });

    Route::controller(SettingController::class)->group(function () {
        Route::get('/settings', 'settings')->name('admin.settings');
        Route::get('/userlist', 'userlist')->name('admin.userlist');
        Route::post('/getuserinfo', 'getuserinfo')->name('admin.getuserinfo');
        Route::post('/userForm', 'userForm')->name('admin.userForm');
        Route::post('/addUser', 'addUser')->name('admin.addUser');
        Route::post('deleteImage', 'deleteUserImage')->name('admin.deleteUserImage');
        Route::post('changePassword', 'changePassword')->name('admin.changePassword');
        Route::post('passwordexist', 'passwordExist')->name('admin.passwordexist');
        Route::post('emailexist', 'emailExist')->name('admin.emailexist');
        Route::post('getRolePermission', 'getRolePermission')->name('admin.getRolePermission');

        Route::get('/role', 'role')->name('admin.role');
        Route::post('/add_role', 'add_role')->name('admin.add_role');
        Route::post('edit_role', 'edit_role')->name('admin.edit_role');
        Route::post('delete_role', 'delete_role')->name('admin.delete_role');
        Route::post('/save_settings', 'save_general_settings')->name('admin.save_settings');
        Route::post('/remove_settings', 'remove_general_settings')->name('admin.remove_settings');
        Route::get('/company_information', 'company_information')->name('admin.company_information');
        Route::post('/save_company_information', 'save_settings_information')->name('admin.save_settings_information');
        Route::get('/email', 'email')->name('admin.email');
        Route::post('/testemail', 'testMail')->name('admin.testemail');
        Route::get('/product_category', 'product_category')->name('admin.product_category');
        Route::post('/load_product_category', 'load_product_category_datatable')->name('admin.load_product_category');
        Route::post('/save_product_category', 'save_product_category')->name('admin.save_product_category');
        Route::post('/get_product_category', 'get_product_category')->name('admin.get_product_category');
        Route::post('/delete_product_category', 'delete_product_category')->name('admin.delete_product_category');
        Route::get('/permission', 'permission')->name('admin.permission');
        Route::post('/add_permission', 'add_permission')->name('admin.add_permission');
        Route::post('/edit_permission', 'edit_permission')->name('admin.edit_permission');
        Route::post('/delete_permission', 'delete_permission')->name('admin.delete_permission');
    });
});
