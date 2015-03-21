<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use UnifySchool\School;

class CreateScopedSessionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('scoped_sessions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('school_id');
			$table->string('name');
			$table->boolean('current_session')->default(false);
			$table->timestamps();
		});

		$schools = School::all();

		foreach($schools as $school){
			$school->setSchoolType($school->school_type);
		}

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('scoped_sessions');
	}

}
