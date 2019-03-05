<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTUploadDocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T_UPLOAD_DOC', function (Blueprint $table) {
            $table->increments('UPLOAD_DOC_ID');
            $table->string('DOC_NAME', 300);
            $table->string('FILENAME', 300);
            $table->string('FILETYPE', 300);
            $table->string('FILE_PATH', 500);
            $table->string('DESCRIPTION', 1000)->nullable();
            $table->char('ACTIVE_IND', 1)->nullable();
            $table->string('USER_CREATED', 50)->nullable();
            $table->string('USER_UPDATE', 50)->nullable();
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
        Schema::dropIfExists('T_UPLOAD_DOC');
    }
}
