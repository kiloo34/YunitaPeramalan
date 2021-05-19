<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,  ...$role)
    {
        // dd('masuk midleware', $request->user()->role->nama);
        if (in_array($request->user()->role->nama, $role)) {
            return $next($request);
        } else {
            abort(404);
        }
    }
}
