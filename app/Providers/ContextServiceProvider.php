<?php namespace UnifySchool\Providers;

use Illuminate\Support\ServiceProvider;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\SyslogHandler;
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
        $monolog = \Log::getMonolog();
        $syslog = new SyslogHandler('papertrail');
        $formatter = new LineFormatter('%channel%.%level_name%: %message% %extra%');
        $syslog->setFormatter($formatter);

        $monolog->pushHandler($syslog);
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
