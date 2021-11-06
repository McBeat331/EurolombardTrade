<?php

use App\Http\Controllers\Auth\LoginController;
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
//Route::get('/language', [App\Http\Controllers\HomeController::class, 'main'])->name('main');


Route::group(['prefix' => parseLocale(),'where' => ['locale' => '[a-z]{2}'],'middleware' => ['localization']], function() {

    Auth::routes(['register' => false]);

    Route::get('/', [App\Http\Controllers\HomeController::class, 'main'])->name('main');
    /*Route::get('advantage', [App\Http\Controllers\AdvantageController::class, 'index'])->name('advantage.index');
    Route::get('advantage/{slug}', [App\Http\Controllers\AdvantageController::class, 'show'])->name('advantage.show');
    Route::get('service', [App\Http\Controllers\ServiceController::class, 'index'])->name('service.index');
    Route::get('service/{slug}', [App\Http\Controllers\ServiceController::class, 'show'])->name('service.show');*/
    Route::get('contact', [App\Http\Controllers\ContactController::class, 'show'])->name('contact.show');
   /* Route::get('review', [App\Http\Controllers\ReviewController::class, 'index'])->name('review.index');*/
    Route::get('order', [App\Http\Controllers\OrderController::class,'show']);
//    Route::get('get-departments',  [App\Http\Controllers\ContactController::class, 'getDepartments'])->name('departments.getDepartments');
});

Route::post('reviewMail', [App\Http\Controllers\ReviewController::class, 'store'])->name('review.store');
Route::post('feedbackMail', [App\Http\Controllers\ServiceController::class, 'createFeedback'])->name('feedback.store');
Route::post('callbackMail', [App\Http\Controllers\ContactController::class, 'createCallback'])->name('callback.store');

Route::post('order', [App\Http\Controllers\OrderController::class,'add']);
Route::get('/thankYou', function () {
    return view('thankYou.thankTou');
})->name('thankYou');
//Route::middleware('auth')->group(function(){
////    Route::get('profile',[App\Http\Controllers\UserController::class,'profile'])->name('profile.show');
////    Route::post('order/{id}', [App\Http\Controllers\OrderController::class,'delete']);
//    Route::get('logout', [LoginController::class,'logout'])->name('logout');
//});

Route::name('admin.')->prefix('admin')->middleware('isAdmin')->group(function(){
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class,'index'])->name('main');
    Route::get('logout', [LoginController::class,'logout'])->name('logout');

    Route::resource('advantage', App\Http\Controllers\Admin\AdvantageController::class);
    Route::resource('address', App\Http\Controllers\Admin\AddressController::class);
    Route::resource('city', App\Http\Controllers\Admin\CityController::class);
    Route::resource('order', App\Http\Controllers\Admin\OrderController::class);
    Route::resource('pages', App\Http\Controllers\Admin\PageController::class);
    Route::resource('review', App\Http\Controllers\Admin\ReviewController::class);
    Route::resource('service', App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('setting', App\Http\Controllers\Admin\SettingController::class);
    Route::resource('user', App\Http\Controllers\Admin\UserController::class);
    Route::resource('feedback', App\Http\Controllers\Admin\FeedbackController::class);
    Route::resource('callback', App\Http\Controllers\Admin\CallbackController::class);

    Route::post('changeStatusOrder', [App\Http\Controllers\Admin\OrderController::class,'changeStatus'])->name('changeStatusOrder');
    Route::post('changeStatusReview', [App\Http\Controllers\Admin\ReviewController::class,'changeStatus'])->name('changeStatusReview');
    Route::post('changeStatusFeedback', [App\Http\Controllers\Admin\FeedbackController::class,'changeStatus'])->name('changeStatusFeedback');
    Route::post('changeStatusCallback', [App\Http\Controllers\Admin\CallbackController::class,'changeStatus'])->name('changeStatusCallback');
});


Route::name('ajax.')->prefix('ajax')->group(function() {
    Route::post('getRatesByCity', [\App\Http\Controllers\AddressController::class, 'getRatesByCity'])->name('getRatesByCity');
    Route::post('getCityCurrent', [\App\Http\Controllers\AddressController::class, 'getCityCurrent'])->name('getCityCurrent');

    Route::post('getCities', [\App\Http\Controllers\AddressController::class, 'getCities'])->name('getCities');
});
