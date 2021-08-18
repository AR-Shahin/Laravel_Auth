<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class CustomVerifyRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // dd($request->user()->getTable());
        if (is_null($request->user()->email_verified_at)) {
            if ($request->user()->getTable() === 'admins') {
                return redirect()->route('admin.verification.notice');
            } else if ($request->user()->getTable() === 'users') {
                return redirect()->route('verification.notice');
            }
        }
        return $next($request);
    }
}
