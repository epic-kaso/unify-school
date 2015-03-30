<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScopedGradingSystemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('scoped_grading_systems', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('school_id');
			$table->string('name');
			$table->string('slug');
			$table->text('grades');
			$table->timestamps();

			$table->unique(['school_id','slug']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('scoped_grading_systems');
	}

}
