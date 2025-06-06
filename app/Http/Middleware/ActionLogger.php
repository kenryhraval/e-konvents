<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ActionLogger
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (Auth::check()) {
            Log::channel('audit')->info('User action', [
                'user_id' => Auth::id(),
                'route' => $request->route()->getName(),
                'method' => $request->method(),
                'uri' => $request->path(),
                'ip' => $request->ip(),
                'input' => $request->except(['password', 
                    'password_confirmation', 
                    '_token', 
                ]),
            ]);
        }

        return $response;
    }
}

