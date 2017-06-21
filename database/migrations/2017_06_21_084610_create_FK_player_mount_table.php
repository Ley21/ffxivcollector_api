<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFKPlayerMountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FK_player_mount', function (Blueprint $table) {
            $table->integer('player_id');
            $table->integer('mount_id');
            $table->primary(['player_id','mount_id']);
            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('mount_id')->references('id')->on('mounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('FK_player_mount');
    }
}
