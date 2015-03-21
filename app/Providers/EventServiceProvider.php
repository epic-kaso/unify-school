<?php namespace UnifySchool\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use UnifySchool\Events\NewSchoolRegistered;
use UnifySchool\Events\TertiaryOrNonTertiarySchoolTypeDetected;
use UnifySchool\Handlers\Events\EmailNewSchoolAccountDetails;
use UnifySchool\Handlers\Events\GenerateDefaultSessionsForSchool;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        NewSchoolRegistered::class => [
            EmailNewSchoolAccountDetails::class
        ],
        TertiaryOrNonTertiarySchoolTypeDetected::class => [
            GenerateDefaultSessionsForSchool::class
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }

}
