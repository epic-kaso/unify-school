<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSchoolsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('schools', function (Blueprint $table)
		{
			$table->increments('id');
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('hashcode');
            $table->integer('school_type_id');
            $table->text('school_object');
			$table->timestamps();
            $table->unique(['name', 'city', 'state', 'country']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('schools');
	}

}
