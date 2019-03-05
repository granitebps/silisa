<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoDesaPembangkitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T_INFO_DESA_PEMBANGKIT', function (Blueprint $table) {
            $table->increments('ID_INFO_DESA_PEMBANGKIT');
            $table->integer('ID_DESA')->unsigned();
            $table->string('PLN_GRID_ISOLATED', 200)->nullable();
            $table->string('JENIS_PEMBANGKIT_ISOLATED', 200)->nullable();
            $table->integer('JAM_NYALA_PLN')->nullable();
            $table->string('GRID_KOMUNAL_STANDALONE', 200)->nullable();
            $table->string('JENIS_PEMBANGKIT', 200)->nullable();
            $table->string('JAM_NYALA_NON_PLN', 200)->nullable();
            $table->string('STATUS_KONDISI_PASOKAN_LISTRIK', 200)->nullable();
            $table->string('KETERANGAN', 300)->nullable();
            $table->integer('TRIWULAN')->nullable();
            $table->integer('TAHUN')->nullable();
            $table->string('SOURCE', 20)->default('EXCEL');
            $table->string('DESCRIPTION', 1000)->nullable();
            $table->char('ACTIVE_IND', 1)->nullable();
            $table->string('USER_CREATED', 50)->nullable();
            $table->string('USER_UPDATED', 50)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('ID_DESA')->references('ID_DESA')->on('M_DESA');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('T_INFO_DESA_PEMBANGKIT');
    }
}
