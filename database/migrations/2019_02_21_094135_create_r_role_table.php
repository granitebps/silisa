<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('R_ROLE', function (Blueprint $table) {
            $table->increments('ROLE_ID');
            $table->string('ROLE_NAME', 200);
            $table->string('GROUP', 200);
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
        Schema::dropIfExists('R_ROLE');
    }
}
