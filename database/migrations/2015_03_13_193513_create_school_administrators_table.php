<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSchoolAdministratorsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_administrators', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id');
            $table->string('name');
            $table->string('email');
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
            $table->unique(['email', 'school_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('school_administrators');
    }

}
