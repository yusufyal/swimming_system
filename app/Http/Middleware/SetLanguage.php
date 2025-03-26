<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('lang')) {
            $locale = $request->session()->get('lang');
            App::setLocale($locale); // Set the locale

            // Set the direction based on the selected language
            if ($locale === 'ar') {
                $request->session()->put('direction', 'rtl');
            } else {
                $request->session()->put('direction', 'ltr');
            }
        }
 
        return $next($request);
    }
}
