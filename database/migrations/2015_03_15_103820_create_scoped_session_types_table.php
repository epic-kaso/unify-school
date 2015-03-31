<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScopedSessionTypesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scoped_session_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id');
            $table->string('session_type');
            $table->string('session_name');
            $table->string('session_display_name');
            $table->string('session_divisions_name');
            $table->string('session_divisions_display_name');
            $table->timestamps();

            $table->unique(['school_id','session_name','session_type'],'school_session');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('scoped_session_types');
    }

}
