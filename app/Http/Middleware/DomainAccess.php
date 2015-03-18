<?php namespace UnifySchool\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\Model;
use UnifySchool\School;

class DomainAccess
{

    protected $specialSubDomains = ['www', 'unify'];
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
            if(is_object($validProgram) && is_subclass_of($validProgram, Model::class)){
                $this->bindContextToSchool($validProgram);
            }
        }

        return $next($request);
    }


    public function check()
    {
        if ($this->isRequestForDomain()) {
            return true;
        }

        $subDomain = $this->extractSubDomainName();

        $needsLookup = true;

        if (\Cache::has('global_school_context')) {
            $school = \Cache::get('global_school_context');
            if ($subDomain == $school->slug) {
                return $school;
            }
        }

        if ($needsLookup) {
            \Cache::forget('global_school_context');

            if ($this->isSpecialSubDomain($subDomain)) {
                return true;
            }

            $school = School::isActive()->bySlug($subDomain);

            if (!$school) {
                return false;

            } else {

                $this->ensureObjectIsASchool($school);

                \Cache::put('global_school_context', $school, \Config::get('session.lifetime'));
                return $school;
            }
        }

    }

    private function isRequestForDomain()
    {
        return \Request::server('HTTP_HOST') == \Config::get('unify.domain');
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

    private function isSpecialSubDomain($subDomain)
    {
        if (in_array(strtolower($subDomain), $this->specialSubDomains)) {
            return true;
        }
        return false;
    }

    private function ensureObjectIsASchool($school)
    {
        if (is_null($school) || !is_subclass_of($school, Model::class)) {
            abort(404);
        }

        return true;
    }

    private function bindContextToSchool(School $school)
    {
        $context = \App::make('UnifySchool\Entities\Context\ContextInterface');

        if (is_null($school) || !is_subclass_of($school, Model::class)) {
            abort(404);
        }
        $context->set($school);

        return $school;
    }
}
