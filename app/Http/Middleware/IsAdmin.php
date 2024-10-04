<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role->name !== 'admin') {
            return response()->json(['message' => 'No autorizado.'], 403);
        }

        return $next($request);
    }
}

