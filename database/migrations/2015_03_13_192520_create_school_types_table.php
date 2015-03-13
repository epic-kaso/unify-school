<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSchoolTypesTable extends Migration
{

    /**
     * Run the migrations.
     *
     *
     * @return void
     */
    public function up()
    {
        /*

        {
        "name": "tertiary",
        "display_name": "Tertiary (Universities, Poly etc)",
        "session":
        "school_categories": [
          ,
          {
            "display_name": "Physical Sciences",
            "name": "physical_sciences",
            "arms": [
              {
                "display_name": "Computer Science",
                "name": "computer_science",
                "arms": {
                  "default": {}
                }
              }
            ]
          },
          {
            "display_name": "Engineering",
            "name": "engineering",
            "arms": [
              {
                "display_name": "Electronics and Computer",
                "name": "electronics_and_computer",
                "arms": {
                  "default": {}
                }
              }
            ]
          },
          {
            "display_name": "Environmental Sciences",
            "name": "environmental",
            "arms": [
              {
                "display_name": "Architecture",
                "name": "architecture",
                "arms": {
                  "default": {}
                }
              }
            ]
          }
        ]
      },
         */
        Schema::create('school_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('display_name');
            $table->integer('session_type_id');
            $table->text('school_categories');
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
        Schema::drop('school_types');
    }

}
