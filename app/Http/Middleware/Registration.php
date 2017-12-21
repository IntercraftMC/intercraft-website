<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\RegisterRequest;

class Registration
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
        $token = $request->query('token');
        if (RegisterRequest::where('token', $token)->count() == 0 && !session('registered'))
            return redirect()->route('home');
        return $next($request);
    }
}
