<?php namespace UnifySchool\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\Model;
use UnifySchool\School;

class BindContext
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
        $slug = null;
        $route = $request->route();
        if (!is_null($route))
            $slug = $route->getParameter('school_slug');

        $slug = is_null($slug) ? $request->get('school') : $slug;

        if (!is_null($slug)) {
            $this->bindContextToSchool($slug);
        }
        return $next($request);
    }

    private function bindContextToSchool($slug)
    {
        $context = \App::make('UnifySchool\Entities\Context\ContextInterface');
        $school = School::bySlug($slug);
        if (is_null($school) || !is_subclass_of($school, Model::class)) {
            abort(404);
        }
        $context->set($school);
        return $school;
    }

}
