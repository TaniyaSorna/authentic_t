<?php

namespace App\Http\Middleware;

use App\helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenVerifyToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('token');
        $verify = JWTToken::verifyToken($token);
        if ($verify === 'unauth') {
            return redirect('login');
        } else {
            $request->headers->set('email', $verify->userEmail);
            $request->headers->set('id', $verify->userId);
            return $next($request);
        }
    }
}
