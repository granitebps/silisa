<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTUploadVerifTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T_UPLOAD_VERIF', function (Blueprint $table) {
            $table->increments('UPLOAD_VERIF_ID');
            $table->integer('UPLOAD_DOC_ID')->unsigned();
            $table->integer('VERIF_STATUS_ID')->unsigned();
            $table->string('VERIFICATOR', 50);
            $table->date('VERIF_DATE');
            $table->string('DESCRIPTION', 1000);
            $table->char('ACTIVE_IND', 1);
            $table->string('USER_CREATED', 50);
            $table->string('USER_UPDATE', 50);
            $table->timestamps();

            $table->foreign('UPLOAD_DOC_ID')->references('UPLOAD_DOC_ID')->on('T_UPLOAD_DOC');
            $table->foreign('VERIF_STATUS_ID')->references('VERIF_STATUS_ID')->on('M_VERIF_STATUS');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('T_UPLOAD_VERIF');
    }
}
