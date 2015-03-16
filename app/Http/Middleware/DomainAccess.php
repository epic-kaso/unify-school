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

    // The method within the filter called 'check'
// Returns Bool/Object
    public function check()
    {
        $server = explode('.', \Request::server('HTTP_HOST'));
        $subdomain = $server[0];
        $needsLookup = true;

        // Does a cached index already exist?
        if (\Cache::has('school')) {
            $school_slug = \Cache::get('school');
            // Compare the cached program against the subdomain.
            if ($subdomain == $school_slug) {
                $needsLookup = false;
                return $school_slug;
            }
        }

        // Do I need to go and lookup the subdomain and confirm it's valid?
        if ($needsLookup) {
            \Cache::forget('school');

            $school = School::bySlug($subdomain);
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
}
