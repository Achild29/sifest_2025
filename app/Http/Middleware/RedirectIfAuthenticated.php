<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\UserRole;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated as MiddlewareRedirectIfAuthenticated;

class RedirectIfAuthenticated extends MiddlewareRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $roles = [
            'admin' => UserRole::admin,
            'guru' => UserRole::guru,
            'siswa' => UserRole::siswa
        ];
        foreach (array_keys($roles) as $guard) {
            if (Auth::guard(Str::lower($guard))->check()) {
                return redirect(route("$guard.dashboard"));
                break;
            }
        }
        return $next($request);
    }
}
