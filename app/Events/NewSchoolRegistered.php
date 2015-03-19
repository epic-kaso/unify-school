<?php namespace UnifySchool\Events;

use Illuminate\Queue\SerializesModels;
use UnifySchool\School;

class NewSchoolRegistered extends Event {

	use SerializesModels;

    protected $school;
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(School $school)
	{
		//
        $this->school = $school;
    }

    /**
     * @return School
     */
    public function getSchool()
    {
        return $this->school;
    }

}
