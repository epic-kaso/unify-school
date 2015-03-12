<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class SwapSubscribersTableCreate extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('swap_subscribers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('phone');
            $table->integer('swap_location_id');
            $table->string('device_make');
            $table->string('device_model');
            $table->string('device_size');
            $table->string('device_network');
            $table->string('device_condition');
            $table->string('device_reward');
            $table->string('swap_location');
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
        Schema::drop('swap_subscribers');
    }

}
