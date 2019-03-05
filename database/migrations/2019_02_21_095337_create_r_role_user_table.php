<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('R_ROLE_USER', function (Blueprint $table) {
            $table->increments('ROLE_USER_ID');
            $table->integer('USER_ID')->unsigned();
            $table->integer('ROLE_ID')->unsigned();
            $table->string('DESCRIPTION', 1000);
            $table->char('ACTIVE_IND', 1);
            $table->string('USER_CREATED', 50);
            $table->string('USER_UPDATE', 50);
            $table->timestamps();

            $table->foreign('USER_ID')->references('USER_ID')->on('R_USER');
            $table->foreign('ROLE_ID')->references('ROLE_ID')->on('R_ROLE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('R_ROLE_USER');
    }
}
