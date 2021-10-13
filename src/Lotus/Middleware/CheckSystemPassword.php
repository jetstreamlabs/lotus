<?php

namespace Serenity\Lotus\Middleware;

use Closure;

class CheckSystemPassword
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
		if ($request->user()->system_password) {
			return redirect(route('system.password'));
		}

		return $next($request);
	}
}
