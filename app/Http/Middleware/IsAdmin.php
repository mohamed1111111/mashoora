<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class IsAdmin
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
      if(!Auth::user()){
        return redirect()->route('login');

          }
      if(Auth::user()->type == 1){
              return $next($request);
          }

        else{
          Auth::logout();
          return redirect('/');

        }
      }
}
