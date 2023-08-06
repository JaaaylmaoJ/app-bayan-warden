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
        Schema::create('tg_user_score_flows', function (Blueprint $table) {
            $table->id();
            $table->integer('shift');
            $table->integer('chat_id');
            $table->integer('user_id');
            $table->string('context_id');
            $table->text('description');
            $table->timestampsTz();

            $table->foreign('context_id')->references('id')->on('score_contexts')->cascadeOnUpdate()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tg_user_score_flows');
    }
};
