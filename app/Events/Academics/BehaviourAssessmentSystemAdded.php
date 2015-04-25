<?php namespace UnifySchool\Events\Academics;

use UnifySchool\Events\Event;

use Illuminate\Queue\SerializesModels;

class BehaviourAssessmentSystemAdded extends Event {

	use SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

}
