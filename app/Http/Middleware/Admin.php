<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
    	if (!auth()->user()->isAdmin()) {
    		return redirect()
			    ->route('homepage')
		        ->withErrors(['Вы не можете просматривать эту страницу!']);
	    }

        return $next($request);
    }
}
