<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdmin
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
        if (Auth::user() && (Auth::user()->admin == 1)) {
            return $next($request);
        }

        if ($request->is('api/*')) {
            return response()->json(['error' => 'You have not admin access'], 403);
        }

        return redirect('home')->with('error', 'You have not admin access');
    }
}
