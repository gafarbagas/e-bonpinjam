<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $this->guards = $guards;
        $this->authenticate($request, $guards);
        return $next($request);
    }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        // if (in_array('masyarakat', $this->guards)){
        //     return route('login');
        // }
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
