<?php

namespace App\Http\Middleware;

use Closure;

class HttpsProtocol {

    public function handle($request, Closure $next)
    {
        $request->setTrustedProxies( [ $request->getClientIp() ] );
        if (!$request->secure()) {
            return redirect()->secure($request->getRequestUri());
        }
        return $next($request); 
    }
}