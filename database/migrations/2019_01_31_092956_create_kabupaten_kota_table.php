<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKabupatenKotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('M_KABUPATEN_KOTA', function (Blueprint $table) {
            $table->increments('ID_KABUPATEN_KOTA');
            $table->integer('ID_PROVINSI')->unsigned();
            $table->string('KODE_KABUPATEN_KOTA', 45)->nullable();
            $table->string('NAMA_KABUPATEN_KOTA', 300);
            $table->string('GRUP', 45)->nullable();
            $table->string('DESCRIPTION', 1000)->nullable();
            $table->char('ACTIVE_IND', 1)->nullable();
            $table->string('USER_CREATED', 50)->nullable();
            $table->string('USER_UPDATED', 50)->nullable();
            $table->timestamps();

            $table->foreign('ID_PROVINSI')->references('ID_PROVINSI')->on('M_PROVINSI');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('M_KABUPATEN_KOTA');
    }
}
