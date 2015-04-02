<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAssignedCoursesColumnToScopedSchoolCats extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('scoped_school_categories', function(Blueprint $table)
		{
			$table->text('assigned_courses');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('scoped_school_categories', function(Blueprint $table)
		{
			$table->dropColumn('assigned_courses');
		});
	}

}
