<?php
	
	namespace UnifySchool\Entities\Legacy\Adapters;
	
	class ImportException extends \Exception
	{
		public function __construct($message){
			parent::__construct($message);
		}
	}