<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFKPlayerMinionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FK_player_minion', function (Blueprint $table) {
            $table->integer('player_id');
            $table->integer('minion_id');
            $table->primary(['player_id','minion_id']);
            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('minion_id')->references('id')->on('minions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('FK_player_minion');
    }
}
