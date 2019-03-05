<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDesaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('M_DESA', function (Blueprint $table) {
            $table->increments('ID_DESA');
            $table->integer('ID_KECAMATAN')->unsigned();
            $table->string('KODE_DESA', 45);
            $table->string('NAMA_DESA', 300);
            $table->string('WILAYAH', 200)->nullable();
            $table->double('LINTANG')->nullable();
            $table->double('BUJUR')->nullable();
            $table->string('RAYON', 200)->nullable();
            $table->string('AREA', 200)->nullable();
            $table->string('DESCRIPTION', 1000)->nullable();
            $table->char('ACTIVE_IND', 1)->nullable();
            $table->string('USER_CREATED', 50)->nullable();
            $table->string('USER_UPDATED', 50)->nullable();
            $table->timestamps();

            $table->foreign('ID_KECAMATAN')->references('ID_KECAMATAN')->on('M_KECAMATAN');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('M_DESA');
    }
}
