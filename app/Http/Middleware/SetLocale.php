<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $supportedLocales = ['en', 'lv'];

        // Check session first
        $locale = session('locale');

        // If session doesn't have a locale, detect from browser
        if (!$locale) {
            $locale = $request->getPreferredLanguage($supportedLocales);
        }

        // Fallback to default locale
        if (!in_array($locale, $supportedLocales)) {
            $locale = config('app.locale');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
