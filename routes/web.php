<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'main']);

Route::middleware('auth')->group(function(){
    Route::post('order', [App\Http\Controllers\OrderController::class,'add']);
    Route::post('order/{id}', [App\Http\Controllers\OrderController::class,'delete']);
});

Route::name('admin.')->prefix('admin')->middleware('isAdmin')->group(function(){
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class,'index']);
    Route::resource('advantage', App\Http\Controllers\Admin\AdvantageController::class);
    Route::resource('address', App\Http\Controllers\Admin\AddressController::class);
    Route::resource('city', App\Http\Controllers\Admin\CityController::class);
    Route::resource('order', App\Http\Controllers\Admin\OrderController::class);
    Route::resource('post', App\Http\Controllers\Admin\PostController::class);
    Route::resource('review', App\Http\Controllers\Admin\ReviewController::class);
    Route::resource('service', App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('setting', App\Http\Controllers\Admin\SettingController::class);
    Route::resource('user', App\Http\Controllers\Admin\UserController::class);
});
