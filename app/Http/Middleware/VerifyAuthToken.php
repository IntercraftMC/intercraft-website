<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class VerifyAuthToken
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
    	if (isset($request->input()['token']) && User::where("token", $request->token)->first())
            return $next($request);
        return jsonResponse("{}", 401);
    }
}
