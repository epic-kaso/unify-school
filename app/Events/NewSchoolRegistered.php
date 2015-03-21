<?php namespace UnifySchool\Events;

use Illuminate\Queue\SerializesModels;
use Log;
use UnifySchool\Entities\School\SchoolAdministrator;
use UnifySchool\School;

class NewSchoolRegistered extends Event {

	use SerializesModels;

    protected $school;
    /**
     * @var SchoolAdministrator
     */
    private $administrator;

    /**
     * Create a new event instance.
     *
     * @param School $school
     * @param SchoolAdministrator $administrator
     */
	public function __construct(School $school,SchoolAdministrator $administrator)
	{
		Log::debug('NewSchoolRegistered event raised');
        $this->school = $school;
        $this->administrator = $administrator;
    }

    /**
     * @return School
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * @return SchoolAdministrator
     */
    public function getAdministrator()
    {
        return $this->administrator;
    }

}
