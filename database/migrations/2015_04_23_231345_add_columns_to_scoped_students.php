<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToScopedStudents extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('scoped_students', function(Blueprint $table)
		{
			$table->string('sex')->nullable();
            $table->longText('picture')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('scoped_students', function(Blueprint $table)
		{
			$table->dropColumn(['sex','picture']);
		});
	}

}
