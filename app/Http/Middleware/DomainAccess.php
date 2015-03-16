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
            is_string($validProgram) ? $this->bindContextToSchool($validProgram) : null;
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

        if (\Cache::has('school')) {
            $school_slug = \Cache::get('school');
            if ($subDomain == $school_slug) {
                return $school_slug;
            }
        }

        if ($needsLookup) {
            \Cache::forget('school');

            if ($this->isSpecialSubDomain($subDomain)) {
                return true;
            }

            $school = School::bySlug($subDomain);

            if (!$school) {
                return false;

            } else {

                $this->ensureObjectIsASchool($school);

                \Cache::put('school', $school->slug, \Config::get('session.lifetime'));
                return $school->slug;
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
