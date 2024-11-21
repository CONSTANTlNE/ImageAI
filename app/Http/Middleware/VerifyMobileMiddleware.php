<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyMobileMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Check if the user is authenticated and if their mobile number is verified
        if ($user && !$user->mob_verified) {
            // Redirect to mobile verification page if mobile is not verified

            return redirect()->route('verify.mobile.index');
        }

        return $next($request);
    }
}
