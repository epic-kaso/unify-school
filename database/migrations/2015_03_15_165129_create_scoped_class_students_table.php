<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScopedClassStudentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scoped_class_students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id');
            $table->integer('scoped_student_id');
            $table->integer('scoped_school_category_arm_subdivision_id');
            $table->string('academic_session');
            $table->timestamps();

            $table->unique(['scoped_student_id', 'school_id', 'scoped_school_category_arm_subdivision_id'],
                'student_school_school_category_arm_subdivision');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('scoped_class_students');
    }

}
