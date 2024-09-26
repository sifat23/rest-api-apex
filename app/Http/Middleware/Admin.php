<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->role === RoleEnum::ADMIN->value) {
            return $next($request);
        }

        return response()->json([
            'message' => 'You do not have the required permissions to perform this action.'
        ], 401);
    }
}
