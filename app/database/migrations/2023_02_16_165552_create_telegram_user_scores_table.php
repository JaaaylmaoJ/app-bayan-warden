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
        Schema::create('telegram_user_scores', function (Blueprint $table) {
            $table->id();
            $table->integer('score');
            $table->integer('chat_id');
            $table->integer('user_id');
            $table->string('context');
            $table->text('description');
            $table->timestamps();

            $table->foreign('context')->references('id')->on('score_context');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telegram_user_scores');
    }
};
