<?php namespace UnifySchool\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use UnifySchool\Events\Academics\BehaviourAssessmentSystemAdded;
use UnifySchool\Events\Academics\GradeAssessmentSystemAdded;
use UnifySchool\Events\Academics\GradingSystemAdded;
use UnifySchool\Events\NewSchoolRegistered;
use UnifySchool\Events\SessionAndTerm\CurrentSessionSet;
use UnifySchool\Events\TertiaryOrNonTertiarySchoolTypeDetected;
use UnifySchool\Handlers\Events\ActivateBasicModules;
use UnifySchool\Handlers\Events\EmailNewSchoolAccountDetails;
use UnifySchool\Handlers\Events\GenerateDefaultSessionsForSchool;
use UnifySchool\Handlers\Events\SchoolConfigStatusHandler;
use UnifySchool\Handlers\Events\SchoolLoginEventHandler;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        NewSchoolRegistered::class => [
            ActivateBasicModules::class,
            EmailNewSchoolAccountDetails::class
        ],
        TertiaryOrNonTertiarySchoolTypeDetected::class => [
            GenerateDefaultSessionsForSchool::class
        ],
        BehaviourAssessmentSystemAdded::class  => [
            SchoolConfigStatusHandler::class
        ],
        GradeAssessmentSystemAdded::class  => [
            SchoolConfigStatusHandler::class
        ],
        GradingSystemAdded::class  => [
            SchoolConfigStatusHandler::class
        ],
        CurrentSessionSet::class  => [
            SchoolConfigStatusHandler::class
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

        $events->listen('school.auth.logout',SchoolLoginEventHandler::class);

        //
    }

}
