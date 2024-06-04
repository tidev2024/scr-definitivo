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
        $permissions = array_map(function($permission) {
            return $permission['name'];
        }, $user->permissions->toArray());
        if ($user->master || in_array($permission, $permissions)) {
            return $next($request);
        }
        return redirect()->route('home')->with('message', [
            'type' => 'danger',
            'message' => 'Acesso negado'
        ]);
    }
}
