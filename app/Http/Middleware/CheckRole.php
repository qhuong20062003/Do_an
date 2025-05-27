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
    public function handle($request, Closure $next, ...$roles)
{
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    $user = auth()->user();
    
    // $roles luôn là mảng (dù bạn chỉ truyền 1 role)
    if (!in_array($user->role, $roles)) {
        abort(403, 'Bạn không có quyền truy cập');
    }

    return $next($request);
}

}
