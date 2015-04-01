<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStartEndDatesToScopedSubSessionTypes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('scoped_sub_session_types', function(Blueprint $table)
		{
			$table->date('start_date')->nullable();
			$table->date('end_date')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('scoped_sub_session_types', function(Blueprint $table)
		{
			$table->dropColumn(['start_date','end_date']);
		});
	}

}
