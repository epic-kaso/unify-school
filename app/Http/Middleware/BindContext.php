<?php namespace UnifySchool\Http\Middleware;

use Closure;
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
        $slug = $request->get('school_slug');
        if (!is_null($slug)) {
            $this->bindContextToSchool($slug);
        }
        return $next($request);
    }

    private function bindContextToSchool($slug)
    {
        $context = \App::make('UnifySchool\Entities\Context\ContextInterface');
        $school = School::bySlug($slug);
        if (is_null($school)) {
            abort(404);
        }
        $context->set($school);
        return $school;
    }

}
