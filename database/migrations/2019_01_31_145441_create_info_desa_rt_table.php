<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoDesaRtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T_INFO_DESA_RT', function (Blueprint $table) {
            $table->increments('ID_INFO_DESA_RT');
            $table->integer('ID_DESA')->unsigned();
            $table->integer('TOTAL_RT')->nullable();
            $table->integer('RT_LISTRIK_PLN')->nullable();
            $table->integer('RT_LISTRIK_PLN_MENYALUR')->nullable();
            $table->integer('RT_LISTRIK_NON_PLN_LTSHE')->nullable();
            $table->integer('RT_LISTRIK_NON_PLN')->nullable();
            $table->integer('RT_TIDAK_BERLISTRIK')->nullable();
            $table->integer('RT_AKAN_DILISTRIK')->nullable();
            $table->integer('RT_BELUM_DAPAT_DILISTRIK')->nullable();
            $table->integer('JUMLAH_CALON_PENERIMA_SUBSIDI')->nullable();
            $table->integer('UPDATE_JMLH_CALON_PENERIMA_SUBSIDI')->nullable();
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
        Schema::dropIfExists('T_INFO_DESA_RT');
    }
}
