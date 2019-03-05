<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDesaPrioritasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T_DESA_PRIORITAS', function (Blueprint $table) {
            $table->increments('ID_DESA_PRIORITAS');
            $table->integer('ID_DESA')->unsigned();
            $table->integer('TERTINGGAL')->nullable();
            $table->integer('TERDEPAN_DAN_TERLUAR')->nullable();
            $table->integer('PKSN')->nullable();
            $table->integer('LOKPRI_BNPP')->nullable();
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
        Schema::dropIfExists('T_DESA_PRIORITAS');
    }
}
