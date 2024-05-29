<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserIsAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (empty(session('user'))) {
            return redirect()->route('login.index')->with('message', [
                'type' => 'warning',
                'message' => 'Faça o login para continuar'
            ]);
        }
        return $next($request);
    }
}
