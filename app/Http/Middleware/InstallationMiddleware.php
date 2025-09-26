<?php

namespace App\Http\Middleware;

use Closure;

class InstallationMiddleware
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
        // Bypass license check if running locally
        $localIps = ['127.0.0.1', '::1'];
        if (in_array($request->ip(), $localIps)) {
            return $next($request);
        }

        // Original license check
        if (!session()->has('purchase_key') && env('PURCHASE_CODE') === null) {
            session()->flash('error', base64_decode('SW52YWxpZCBwdXJjaGFzZSBjb2RlIGZvciB0aGlzIHNvZnR3YXJlLg=='));
            return redirect('step2');
        }

        return $next($request);
    }
}
