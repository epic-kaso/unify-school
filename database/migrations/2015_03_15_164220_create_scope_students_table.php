<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScopeStudentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scoped_students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id');
            $table->string('reg_number');
            $table->string('password');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('other_names');
            $table->string('religion');
            $table->string('complexion');
            $table->string('height');
            $table->boolean('disabled');
            $table->text('disabilities');
            $table->text('blood_group');
            $table->text('genotype');
            $table->date('birth_date');
            $table->text('place_of_birth');
            $table->text('hometown');
            $table->text('state_of_origin');
            $table->text('country_of_origin');

            $table->text('residential_address');
            $table->text('residential_city');
            $table->text('residential_state');
            $table->text('residential_country');

            $table->date('registration_date');

            $table->timestamps();

            $table->unique(['reg_number', 'school_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('scoped_students');
    }

}
