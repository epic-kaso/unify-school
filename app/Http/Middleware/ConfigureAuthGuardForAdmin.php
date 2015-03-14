<?php namespace UnifySchool\Http\Middleware;

use Closure;
use UnifySchool\Entities\School\SchoolAdministrator;

class ConfigureAuthGuardForAdmin
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Config::set('auth.model', SchoolAdministrator::class);
        return $next($request);
    }

}
