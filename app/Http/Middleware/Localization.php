<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class Localization
{
    public function __construct(Redirector $redirector) {
        // $this->app = $app;
        $this->redirector = $redirector;
        // $this->request = $request;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (array_key_exists($request->segment(1), config('app.locales'))) {
            $this->removeDefaultLanguage($request);
            URL::defaults(['locale' => $request->segment(1)]);
            app()->setLocale($request->segment(1));
        } else {
            URL::defaults(['locale' => config('app.fallback_locale')]);
            app()->setLocale(config('app.fallback_locale'));
        }
        return $next($request);
    }
    private function removeDefaultLanguage($request)
    {

        if($request->segment(1) === config('app.fallback_locale')){
            $redirect = $request->segments();
            if(isset($redirect[0])) unset($redirect[0]);
            return $this->redirector->to(implode('/', $redirect));
        }
    }
}
