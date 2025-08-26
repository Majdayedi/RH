<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Get language from session or default to 'en'
        $locale = Session::get('locale', 'en');
        
        // Set the application locale
        App::setLocale($locale);
        
        return $next($request);
    }
}
