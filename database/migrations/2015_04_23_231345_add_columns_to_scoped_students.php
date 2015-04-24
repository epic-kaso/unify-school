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
            $table->longText('medical_conditions')->nullable();
            $table->text('contact_phone')->nullable();
            $table->text('contact_email')->nullable();
            $table->text('contact_address')->nullable();
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
			$table->dropColumn(['sex','picture','medical_conditions','contact_phone','contact_email','contact_address']);
		});
	}

}
