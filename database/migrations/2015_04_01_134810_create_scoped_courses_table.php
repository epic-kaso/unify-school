<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScopedCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('scoped_courses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('school_id');
			$table->integer('scoped_course_category_id');
			$table->string('name');
			$table->string('code');
			$table->string('slug');
			$table->timestamps();

			$table->unique(['school_id','name','scoped_course_category_id'],'unique_course_for_school');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('scoped_courses');
	}

}
