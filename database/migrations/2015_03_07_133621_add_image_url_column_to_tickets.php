<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddImageUrlColumnToTickets extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gadget_swap_tickets', function (Blueprint $table) {
            $table->text('image_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gadget_swap_tickets', function (Blueprint $table) {
            $table->dropColumn('image_url');
        });
    }

}
