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
        $slug = $request->get('school_slug');

        if (!is_null($slug)) {
            $this->bindContextToSchool($slug);
        }
        return $next($request);
    }

    private function bindContextToSchool($slug)
    {
        $context = \App::make('UnifySchool\Entities\Context\ContextInterface');

        if (!is_null($context->get()) && is_subclass_of($context->get(), Model::class)) {
            return $context->get();
        }

        $school = School::bySlug($slug);
        if (is_null($school) || !is_subclass_of($school, Model::class)) {
            abort(404);
        }
        $context->set($school);
        return $school;
    }

}
