<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyGradingAssesmentSystemScopes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::transaction(function(){
            Schema::table('scoped_school_categories', function(Blueprint $table)
            {
                $table->dropColumn(['scoped_grade_assessment_system_id','scoped_grading_system_id']);
            });

            Schema::table('scoped_school_category_arm_subdivisions', function (Blueprint $table)
            {
                $table->integer('scoped_grade_assessment_system_id')->nullable();
                $table->integer('scoped_grading_system_id')->nullable();
                $table->integer('scoped_behaviour_skill_system_id')->nullable();
            });
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::transaction(function(){
            Schema::table('scoped_school_categories', function(Blueprint $table)
            {
                $table->integer('scoped_grading_system_id')->nullable();
                $table->integer('scoped_grade_assessment_system_id')->nullable();
            });

            Schema::table('scoped_school_category_arm_subdivisions', function (Blueprint $table)
            {
                $table->dropColumn(['scoped_grade_assessment_system_id','scoped_grading_system_id','scoped_behaviour_skill_system_id']);
            });
        });
	}

}
