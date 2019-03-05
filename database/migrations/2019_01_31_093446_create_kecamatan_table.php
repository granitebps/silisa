<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKecamatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('M_KECAMATAN', function (Blueprint $table) {
            $table->increments('ID_KECAMATAN');
            $table->integer('ID_KABUPATEN_KOTA')->unsigned();
            $table->string('KODE_KECAMATAN', 45)->nullable();
            $table->string('NAMA_KECAMATAN', 300);
            $table->string('DESCRIPTION', 1000)->nullable();
            $table->char('ACTIVE_IND', 1)->nullable();
            $table->string('USER_CREATED', 50)->nullable();
            $table->string('USER_UPDATED', 50)->nullable();
            $table->timestamps();

            $table->foreign('ID_KABUPATEN_KOTA')->references('ID_KABUPATEN_KOTA')->on('M_KABUPATEN_KOTA');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('M_KECAMATAN');
    }
}
