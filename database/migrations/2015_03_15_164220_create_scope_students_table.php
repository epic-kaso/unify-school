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
            $table->string('password')->nullable();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('other_names')->nullable();
            $table->string('religion')->nullable();
            $table->string('complexion')->nullable();
            $table->string('height')->nullable();
            $table->boolean('disabled')->nullable();
            $table->text('disabilities')->nullable();
            $table->text('blood_group')->nullable();
            $table->text('genotype')->nullable();
            $table->date('birth_date')->nullable();
            $table->text('place_of_birth')->nullable();
            $table->text('hometown')->nullable();
            $table->text('state_of_origin')->nullable();
            $table->text('country_of_origin')->nullable();
            $table->text('residential_address')->nullable();
            $table->text('residential_city')->nullable();
            $table->text('residential_state')->nullable();
            $table->text('residential_country')->nullable();
            $table->date('registration_date')->nullable();

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
