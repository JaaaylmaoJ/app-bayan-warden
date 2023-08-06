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
        Schema::create('tg_user_scores', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tg_user_id');
            $table->bigInteger('tg_chat_id');
            $table->integer('score');
            $table->timestampsTz();

            $table->foreign('tg_user_id')->references('tg_id')->on('tg_users');
            $table->foreign('tg_chat_id')->references('tg_id')->on('tg_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tg_user_scores');
    }
};
