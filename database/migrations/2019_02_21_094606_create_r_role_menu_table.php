<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRRoleMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('R_ROLE_MENU', function (Blueprint $table) {
            $table->increments('ROLE_MENU_ID');
            $table->integer('ROLE_ID')->unsigned();
            $table->integer('MENU_ID')->unsigned();
            $table->string('DESCRIPTION', 1000);
            $table->char('ACTIVE_IND', 1);
            $table->string('USER_CREATED', 50);
            $table->string('USER_UPDATE', 50);
            $table->timestamps();

            $table->foreign('ROLE_ID')->references('ROLE_ID')->on('R_ROLE');
            $table->foreign('MENU_ID')->references('MENU_ID')->on('R_MENU');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('R_ROLE_MENU');
    }
}
