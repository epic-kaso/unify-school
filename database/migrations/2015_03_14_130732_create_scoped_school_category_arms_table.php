<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScopedSchoolCategoryArmsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scoped_school_category_arms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('scoped_school_category_id');
            $table->integer('school_id');
            $table->string('name');
            $table->string('display_name');
            $table->text('meta');
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
        Schema::drop('scoped_school_category_arms');
    }

}
