<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PersonnelMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isPersonnel()) {
            abort(403, 'Accès refusé');
        }

        return $next($request);
    }
}