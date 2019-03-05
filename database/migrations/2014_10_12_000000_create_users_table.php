<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('R_USER', function (Blueprint $table) {
            $table->increments('USER_ID');
            $table->string('NAMA_USER', 45);
            $table->string('EMAIL')->unique();
            $table->string('PASSWD1');

            $table->string('USERNAME', 50)->nullable();
            $table->string('JABATAN', 300)->nullable();
            $table->string('DIVISI', 300)->nullable();
            $table->string('BIDANG', 300)->nullable();
            $table->string('COMPANY', 300)->nullable();
            $table->string('PHONE', 20)->nullable();
            $table->string('DESCRIPTION', 1000)->nullable();
            $table->char('ACTIVE_IND', 1)->nullable();
            $table->string('USER_CREATED', 50)->nullable();
            $table->string('USER_UPDATE', 50)->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('R_USER');
    }
}
