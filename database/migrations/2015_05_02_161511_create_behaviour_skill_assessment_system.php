<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBehaviourSkillAssessmentSystem extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('scoped_behaviour_skill_systems', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('school_id');
            $table->string('name');
            $table->longText('behaviours');
            $table->longText('skills');
            $table->timestamps();

            $table->unique(['school_id','name']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('scoped_behaviour_skill_systems');
	}

}
