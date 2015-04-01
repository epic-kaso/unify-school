<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('scoped_course_categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('school_id');
			$table->integer('scoped_school_category_id');
			$table->string('name');
			$table->timestamps();

			$table->unique(['school_id','scoped_school_category_id','name'],'unique_course_category');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('scoped_course_categories');
	}

}
