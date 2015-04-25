<?php namespace UnifySchool\Events\SessionAndTerm;

use UnifySchool\Events\Event;

use Illuminate\Queue\SerializesModels;

class CurrentSessionSet extends Event {

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
