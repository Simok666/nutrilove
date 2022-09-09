<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // $guards = empty($guards) ? [null] : $guards;

        /*         foreach ($guards as $guard) { */

            // debug(auth()->check());
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();

            // to admin dashboard
            if ($user->hasRole('admin')) {
                return redirect(Url("admin/dashboard"));
            }

            // to user dashboard
            else if ($user->hasRole('user')) {
                return redirect(route('user.index'));
            }
        }
        /* } */

        return $next($request);
    }
}
