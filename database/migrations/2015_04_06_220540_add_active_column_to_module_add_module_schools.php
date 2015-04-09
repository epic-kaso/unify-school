<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActiveColumnToModuleAddModuleSchools extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('modules', function(Blueprint $table)
        {
           $table->boolean('active')->default(true);
        });

        Schema::table('schools', function (Blueprint $table)
        {
            $table->text('modules')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('modules', function(Blueprint $table)
        {
            $table->dropColumn('active');
        });

        Schema::table('schools', function (Blueprint $table)
        {
            $table->dropColumn('modules');
        });
	}

}
