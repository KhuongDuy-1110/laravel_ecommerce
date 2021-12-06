<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App;
use Session;
use Closure;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $language = $request->session()->get('language', config('app.locale'));
        switch ($language) {
        case 'vi':
            $language = 'vi';
            break;
        
        default:
            $language = 'en';
            break;
        }
        App::setLocale($language);

        return $next($request);
        
    }
}
