<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoDesaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T_INFO_DESA', function (Blueprint $table) {
            $table->increments('ID_INFO_DESA');
            $table->integer('ID_DESA')->unsigned();
            $table->integer('DESA_BERLISTRIK')->nullable();
            $table->integer('DESA_BERLISTRIK_LTSHE')->nullable();
            $table->integer('DESA_BERLISTRIK_NON_PLN')->nullable();
            $table->integer('DESA_BELUM_BERLISTRIK')->nullable();
            $table->double('JARAK_DARI_JARINGAN_EKSISTENSI')->nullable();
            $table->string('KETERANGAN', 200)->nullable();
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
        Schema::dropIfExists('T_INFO_DESA');
    }
}
