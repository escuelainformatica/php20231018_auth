<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Middle1
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role='user'): Response
    {
        //echo "se cargo middleware 1";
        //var_dump($request->user()->nivel);
        if($request->user()->nivel===$role) {
            return $next($request);
        }
        return redirect('login');
    }
}