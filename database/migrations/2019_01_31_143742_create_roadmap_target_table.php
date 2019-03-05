<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoadmapTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T_ROADMAP_TARGET', function (Blueprint $table) {
            $table->increments('ID_ROADMAP_TARGET');
            $table->integer('ID_DESA')->unsigned();
            $table->double('TARGET_PEMBANGKIT')->nullable();
            $table->double('TARGET_JTM')->nullable();
            $table->double('TARGET_JTR')->nullable();
            $table->double('TARGET_GARDU')->nullable();
            $table->integer('TARGET_PELANGGAN')->nullable();
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
        Schema::dropIfExists('T_ROADMAP_TARGET');
    }
}
