<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoDesaMPotensiEnergiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T_INFO_DESA_ENERGI', function (Blueprint $table) {
            $table->increments('ID_INFO_DESA_ENERGI');
            $table->integer('ID_INFO_DESA')->unsigned();
            $table->integer('ID_POTENSI_ENERGI')->unsigned();
            $table->string('SOURCE', 20)->default('EXCEL');
            $table->string('DESCRIPTION', 1000)->nullable();
            $table->char('ACTIVE_IND', 1)->nullable();
            $table->string('USER_CREATED', 50)->nullable();
            $table->string('USER_UPDATED', 50)->nullable();
            $table->timestamps();

            $table->foreign('ID_INFO_DESA')->references('ID_INFO_DESA')->on('T_INFO_DESA');
            $table->foreign('ID_POTENSI_ENERGI')->references('ID_POTENSI_ENERGI')->on('M_POTENSI_ENERGI');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('T_INFO_DESA_ENERGI');
    }
}
