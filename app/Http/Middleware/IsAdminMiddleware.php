<?php

namespace App\Http\Middleware;

use Closure;
use App\UserRole;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Access\AuthorizationException;

class IsAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()?->role !== UserRole::Admin->value) {
            // যদি admin না হয়
            abort(403, 'You do not have access to this page');
        }

        return $next($request);
    }
}

