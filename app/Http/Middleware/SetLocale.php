<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request for both web and API.
     *
     * API priority: query -> X-Locale -> Accept-Language header -> default
     * Web priority: session -> query -> Accept-Language header -> default
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isApi = $request->is('api/*');

        $locale = $isApi ? $request->header('Accept-Language') : session('locale');

        // allowed locales from config (fall back to common list)
        $allowed = config('app.locales', config('app.locales', ['en', 'ar']));
        if (!is_array($allowed)) {
            $allowed = ['en', 'ar'];
        }

        if (!in_array($locale, $allowed, true)) {
            $locale = config('app.locale', $allowed[0] ?? 'en');
        }
        // dd($locale);

        app()->setLocale($locale);

        // For web store the selection in session
        if (! $isApi) {
            session(['locale' => $locale]);
        }

        // // expose locale on request attributes
        // $request->attributes->set('locale', $locale);

        return $next($request);
    }

}
