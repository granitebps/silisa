<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMVerifStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('M_VERIF_STATUS', function (Blueprint $table) {
            $table->increments('VERIF_STATUS_ID');
            $table->string('STATUS_NUM', 2);
            $table->string('STATUS_CODE', 200);
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
        Schema::dropIfExists('M_VERIF_STATUS');
    }
}
