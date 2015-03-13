<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSessionTypesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*

        {
          "session_type": "two",
          "session_name": "session",
          "session_display_name": "Session",
          "session_divisions_name": "sub_session",
          "session_divisions_display_name": "Semester"
        },
         */
        Schema::create('session_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('session_type');
            $table->string('session_name');
            $table->string('session_display_name');
            $table->string('session_divisions_name');
            $table->string('session_divisions_display_name');
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
        Schema::drop('session_types');
    }

}
