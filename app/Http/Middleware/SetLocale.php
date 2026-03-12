<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Get locale from Accept-Language header
        $locale = $request->header('Accept-Language') ?? $request->query('lang', 'en');
        
        // Validate locale 
        $locale = in_array($locale, ['en', 'my']) ? $locale : 'en';
        
        // Set application locale
        App::setLocale($locale);
        
        return $next($request);
    }
}
