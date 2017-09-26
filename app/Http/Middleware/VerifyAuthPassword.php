<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class VerifyAuthPassword
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
        if ($request->filled(["token", "password"])) {
            $user = User::where("token", $request->token)->first();
            if ($user && $user->checkPassword($request->password))
                return $next($request);
        }
        return jsonResponse("{}", 401);
    }
}
