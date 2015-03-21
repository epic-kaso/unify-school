<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScopedSubSessionTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('scoped_sub_session_types', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('school_id');
			$table->integer('scoped_session_type_id');
			$table->string('name');
			$table->string('display_name');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('scoped_sub_session_types');
	}

}
