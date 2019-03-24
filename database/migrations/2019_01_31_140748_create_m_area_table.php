<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('M_AREA', function (Blueprint $table) {
            $table->increments('ID_AREA');
            $table->string('NAMA_AREA', 200);
            $table->string('DESCRIPTION', 1000)->nullable();
            $table->char('ACTIVE_IND', 1)->nullable();
            $table->string('USER_CREATED', 50)->nullable();
            $table->string('USER_UPDATED', 50)->nullable();
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
        Schema::dropIfExists('M_AREA');
    }
}
