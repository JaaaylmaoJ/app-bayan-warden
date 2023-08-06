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
        Schema::create('tg_messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('update_id')->index();
            $table->bigInteger('message_id')->index();
            $table->bigInteger('chat_id')->index();
            $table->bigInteger('from_id')->index();
            $table->bigInteger('sender_chat_id')->index();
            $table->longText('text')->nullable();
            $table->string('author_signature')->index();
            $table->boolean('has_photo')->index();
            $table->boolean('has_video')->index();
            $table->boolean('is_forwarded')->index();
            $table->longText('caption')->nullable();
            $table->timestampTz('date');
            $table->jsonb('message_body');
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
        Schema::dropIfExists('tg_messages');
    }
};
