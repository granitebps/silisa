<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMRayonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('M_RAYON', function (Blueprint $table) {
            $table->increments('ID_RAYON');
            $table->string('NAMA_RAYON', 200);
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
        Schema::dropIfExists('M_RAYON');
    }
}
