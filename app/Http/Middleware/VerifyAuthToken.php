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
    	if ($request->has("token") && $user = User::where("token", $request->token)->first()) {
            if ($user->active)
                return $next($request);
            return jsonResponse('{"error": "account_not_active"}', 401);
        }
        return jsonResponse('{"error": "invalid_auth_token"}', 401);
    }
}
