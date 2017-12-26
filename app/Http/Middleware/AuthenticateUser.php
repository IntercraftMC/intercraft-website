<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class AuthenticateUser
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
        if ($request->filled(['username', 'password'])) {
            $user = User::where('username', $request->username)->first();
            if (!$user || !$user->checkPassword($request->password))
                return jsonResponse("{}", 401);
            return $next($request);
        }
        return jsonResponse("{}", 401);
    }
}
