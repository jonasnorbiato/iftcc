<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Aluno
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
        if(Auth::user()->isAluno())
            return $next($request);
        return redirect('/');
    }
}
