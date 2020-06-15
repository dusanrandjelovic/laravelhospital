<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Tester
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if (!Auth::check()) {
          return redirect()->route('login');
      }
      if (Auth::user()->role_id == 1) {
          return redirect()->route('admin');

      }

      if (Auth::user()->role_id == 2) {

          return redirect()->route('lekar');
      }

      if (Auth::user()->role_id == 3) {
          return redirect()->route('asistent');

      }
      if (Auth::user()->role_id == 4) {
        return $next($request);
      }
    }
}