<?php
	
	namespace UnifySchool\Entities\Legacy\Adapters;
	
	class NoClassDetectedException extends \Exception
	{
		public function __construct($message){
			parent::__construct($message);
		}
	}