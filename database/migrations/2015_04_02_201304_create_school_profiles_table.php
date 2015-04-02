<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('school_profiles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('school_id');
			$table->string('motto');
			$table->string('mission');
			$table->string('vision');
			$table->text('about');
			$table->string('contact_email');
			$table->string('contact_phone_number');
			$table->text('logo');
			$table->string('wallpaper');
			$table->date('established_date');
			$table->timestamps();

			$table->unique(['school_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('school_profiles');
	}

}
