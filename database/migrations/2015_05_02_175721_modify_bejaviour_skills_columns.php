<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyBejaviourSkillsColumns extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('scoped_skills', function(Blueprint $table)
		{
			$table->integer('scoped_behaviour_skill_system_id')->nullable();
		});

        Schema::table('scoped_behaviours', function(Blueprint $table)
        {
            $table->integer('scoped_behaviour_skill_system_id')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('scoped_skills', function(Blueprint $table)
		{
            $table->integer('scoped_behaviour_skill_system_id')->nullable();
		});

        Schema::table('scoped_behaviours', function(Blueprint $table)
        {
            $table->integer('scoped_behaviour_skill_system_id')->nullable();
        });
	}

}
