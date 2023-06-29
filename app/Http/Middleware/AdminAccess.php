<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $item = $request->route('item');

        if ($request->user()->isAdmin() || $request->user()->id === $item->user_id) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');


    }
}
