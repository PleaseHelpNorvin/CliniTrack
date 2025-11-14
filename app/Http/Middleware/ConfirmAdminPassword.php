<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConfirmAdminPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $confirmedAt = $request->session()->get('auth.password_confirmed_at');

        if (!$confirmedAt || (time() - $confirmedAt > 300)) { // 5 min
            return redirect()->route('admin.settings.confirm-password');
        }

        return $next($request);
    }

}
