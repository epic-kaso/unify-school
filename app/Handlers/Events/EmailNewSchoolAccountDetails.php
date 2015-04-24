<?php namespace UnifySchool\Handlers\Events;

use Log;
use Mail;
use UnifySchool\Events\NewSchoolRegistered;
use UnifySchool\School;

class EmailNewSchoolAccountDetails
{

    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewSchoolRegistered $event
     * @return void
     */
    public function handle(NewSchoolRegistered $event)
    {

        Log::debug('New School Register Event handler called');

        $school = $event->getSchool();
        
        $admin_email = $event->getAdministrator()->email;

        Mail::queue('emails.school.new_school', ['school' => $school], 
            function ($message) use ($admin_email) {
                $message
                    ->to($admin_email)
                    ->subject('Successful School Registration, School Details');
        });

    }

}
