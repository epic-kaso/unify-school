<?php namespace UnifySchool\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use UnifySchool\School;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'UnifySchool\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);

//        $router->bind('school_slug', function ($value) {
//            $school = $this->bindContextToSchool($value);
//            return $school;
//        });
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
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
