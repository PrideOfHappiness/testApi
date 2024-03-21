<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $accessLevel): Response
    {
        $user = $request->user();
        if ($user && $user->user_access === $accessLevel) {
            return $next($request);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
