<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSchoolCategoriesTable extends Migration
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
            "display_name": "Arts",
            "name": "arts",
            "arms": [
              {
                "display_name": "Mass Communication",
                "name": "mass_communication",
                "arms": {
                  "default": {}
                }
              },
              {
                "display_name": "English Language",
                "name": "english",
                "arms": {
                  "default": {}
                }
              }
            ]
          }

         */
        Schema::create('school_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('display_name');
            $table->text('arms');
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
        Schema::drop('school_categories');
    }

}
