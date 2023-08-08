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
        Schema::create('tg_unhandled_updates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('update_id')->index()->nullable();
            $table->jsonb('payload');
            $table->timestampTz('handled_at')->nullable();
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
        Schema::dropIfExists('tg_unhandled_updates');
    }
};
