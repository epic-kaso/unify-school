<?php namespace UnifySchool\Providers;

use Illuminate\Support\ServiceProvider;
use UnifySchool\Entities\Context\SchoolContext;

class ContextServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('UnifySchool\Entities\Context\ContextInterface', function ($app) {
            return new SchoolContext();
        });
    }

}
