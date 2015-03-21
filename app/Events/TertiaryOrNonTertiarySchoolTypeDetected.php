<?php namespace UnifySchool\Events;

use UnifySchool\Events\Event;

use Illuminate\Queue\SerializesModels;
use UnifySchool\School;

class TertiaryOrNonTertiarySchoolTypeDetected extends Event {

	use SerializesModels;

	/**
	 * @var School
	 */
	private $school;

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
