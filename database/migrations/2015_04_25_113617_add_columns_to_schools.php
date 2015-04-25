<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToSchools extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('schools', function(Blueprint $table)
		{
			$table->boolean('first_login')->default(true);
            $table->boolean('setup_complete')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('schools', function(Blueprint $table)
		{
			$table->dropColumn(['first_login','setup_complete']);
		});
	}

}
