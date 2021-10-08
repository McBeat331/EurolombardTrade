<?php

use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
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

Route::name('admin.')->prefix('admin')/*->middleware('isAdmin')*/->group(function(){
    Route::resource('address', AddressController::class);
    Route::resource('country', CountryController::class);
    Route::resource('order', OrderController::class);
    Route::resource('post', PostController::class);
    Route::resource('review', ReviewController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('setting', SettingController::class);
    Route::resource('user', UserController::class);
});