<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class CheckTokenExpiration
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

//        dd($request);
//        $token = $request->bearerToken();
        if (Auth::check()) {
            $token = $request->user()->token();
//            dd(Auth::user());

            // Do something with the token...
        }
//        $token = $request->user()->token('TokenLogin');
//
//        dd(11);
//        if ($token && Carbon::parse($token->expires_at)->isPast()) {
//            $request->user()->token()->delete();
//            return route('login');
//            throw new AuthenticationException('Unauthenticated');
//        }

        return $next($request);
    }
}
