<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScopedGradeAssessmentSystemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('scoped_grade_assessment_systems', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('school_id');
			$table->string('name');
			$table->integer('total_score');
			$table->text('divisions');
			$table->timestamps();

			$table->unique(['school_id','name']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('scoped_grade_assessment_systems');
	}

}
