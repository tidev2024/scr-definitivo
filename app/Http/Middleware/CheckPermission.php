<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = Auth::user();
        if ($user->master || $user->permissions->contains('name', $permission)) {
            return $next($request);
        }
        return redirect()->route('home')->with('message', [
            'type' => 'danger',
            'message' => 'Acesso negado'
        ]);
    }
}
