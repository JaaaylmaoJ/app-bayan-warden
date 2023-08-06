<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tg_message_photos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('update_id')->index();
            $table->bigInteger('media_group_id')->index();
            $table->string('file_id')->index();
            $table->string('file_unique_id')->index();
            $table->integer('file_size')->index();
            $table->integer('width')->index();
            $table->integer('height')->index();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tg_message_photos');
    }
};
