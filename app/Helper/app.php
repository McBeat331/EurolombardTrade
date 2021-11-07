<?php

use App\Services\Address\AddressService;
use App\Services\City\CityService;
use Illuminate\Support\Facades\Session;
if(!function_exists('getTelegramLink')){
    function getTelegramLink(){
        $settingService = app()->make( \App\Services\Setting\SettingService::class);
        return 'https://'.$settingService->getFieldValue('telegramLink');
    }
}

if(!function_exists('addresses')){
    function addresses(){
        $cityService = app()->make( AddressService::class);
        return $cityService->getAll(['city']);
    }
}
if(!function_exists('cities')){
    function cities(){
        $cityService = app()->make( CityService::class);
        return $cityService->getHelperCities();
    }
}
if(!function_exists('parseLocale')) {
    function parseLocale()
    {
        $locale = request()->segment(1);
        if (array_key_exists($locale, config('app.locales'))) {
            app()->setLocale($locale);
            return $locale;
        }
        app()->setLocale(config('app.fallback_locale'));  // this default locale
        return '/';
    }
}
if(!function_exists('switcher_locale')) {
    function switcher_locale()
    {
        return view('_partials.switcher');
    }
}
if(!function_exists('citySelected')) {
    function citySelected()
    {
        if(Session::has('citySelected')){
            return Session::get('citySelected');
        }
        return false;
    }
}
if(!function_exists('addressSelectedCity')) {
    function addressSelectedCity()
    {
        $cityService = app()->make(CityService::class);
        $city = $cityService->getDomainFind(request()->getHost());
        return $city;
    }
}
if(!function_exists('getUnreadOrder')){
    function getUnreadOrder(){
        $orderService = app()->make( \App\Services\Order\OrderService::class);
        return $orderService->getUnreadCount();
    }
}
if(!function_exists('getUnreadFeedback')){
    function getUnreadFeedback(){
        $feedbackService = app()->make( \App\Services\Communication\FeedbackServices::class);
        return $feedbackService->getUnreadCount();
    }
}
if(!function_exists('getUnreadCallback')){
    function getUnreadCallback(){
        $callbackService = app()->make( \App\Services\Communication\CallbackServices::class);
        return $callbackService->getUnreadCount();
    }
}
if(!function_exists('getUnreadReview')){
    function getUnreadReview(){
        $reviewService = app()->make( \App\Services\Review\ReviewService::class);
        return $reviewService->getUnreadCount();
    }
}
