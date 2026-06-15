<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TelescopeBasicAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (
            $request->getUser() !== env('TELESCOPE_USER') ||
            $request->getPassword() !== env('TELESCOPE_PASSWORD')
        ) {
            return response('Unauthorized', 401, [
                'WWW-Authenticate' => 'Basic realm="Telescope"',
            ]);
        }

        return $next($request);
    }
}