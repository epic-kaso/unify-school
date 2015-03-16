<?php namespace UnifySchool\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\Model;
use UnifySchool\School;

class DomainAccess
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
        // Checks subdomain is valid and exists in DB.
        $validProgram = $this->check();
        if (!$validProgram) {
            return \Redirect::to('/');
        } else {
            $this->bindContextToSchool($validProgram);
        }

        return $next($request);
    }


    public function check()
    {
        $subDomain = $this->extractSubDomainName();

        $needsLookup = true;

        if (\Cache::has('school')) {
            $school_slug = \Cache::get('school');
            if ($subDomain == $school_slug) {
                return $school_slug;
            }
        }

        if ($needsLookup) {
            \Cache::forget('school');

            $school = School::bySlug($subDomain);
            if (!$school) {
                return false;

            } else {
                \Cache::put('school', $school->slug, \Config::get('session.lifetime'));
                return $school->slug;
            }
        }

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

    /**
     * @return mixed
     */
    private function extractSubDomainName()
    {
        $server = explode('.', \Request::server('HTTP_HOST'));
        $subDomain = $server[0];
        return $subDomain;
    }
}
