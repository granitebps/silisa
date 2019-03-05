<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('R_MENU', function (Blueprint $table) {
            $table->increments('MENU_ID');
            $table->string('MENU', 200);
            $table->string('SUBMENU1', 200);
            $table->string('SUBMENU2', 200);
            $table->string('DESCRIPTION', 1000);
            $table->char('ACTIVE_IND', 1);
            $table->string('USER_CREATED', 50);
            $table->string('USER_UPDATE', 50);
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
        Schema::dropIfExists('R_MENU');
    }
}
