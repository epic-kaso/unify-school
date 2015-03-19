<?php namespace UnifySchool\Handlers\Events;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use UnifySchool\Events\NewSchoolRegistered;
use UnifySchool\School;

class EmailNewSchoolAccountDetails implements ShouldBeQueued {

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
	 * @param  NewSchoolRegistered  $event
	 * @return void
	 */
	public function handle(NewSchoolRegistered $event)
	{

        $school = $event->getSchool()->load(School::$relationData);
        $admin_email = $school->administrator->email;

        \Mail::send('emails.school.new_school', ['school' => $school], function($message) use($admin_email)
        {
            $message->from('no-reply@kaso.co', 'Unify Schools Project:: Klipboard');
            $message->to($admin_email)
                ->subject('Successful School Registration, School Details');
        });

	}

}
