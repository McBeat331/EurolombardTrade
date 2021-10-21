<?php

use App\Services\City\CityService;


if(!function_exists('cities')){
    function cities(){
        return (new CityService)->getAll(['addresses']);
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
