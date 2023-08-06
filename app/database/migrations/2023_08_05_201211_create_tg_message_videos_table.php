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
        Schema::create('tg_message_videos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('update_id')->index();
            $table->bigInteger('media_group_id')->index();
            $table->bigInteger('duration');
            $table->string('file_name');
            $table->string('mime_type');
            $table->string('file_id')->index();
            $table->string('file_unique_id')->index();
            $table->bigInteger('file_size');
            $table->jsonb('thumbnail');
            $table->jsonb('thumb');
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
        Schema::dropIfExists('tg_message_videos');
    }
};
