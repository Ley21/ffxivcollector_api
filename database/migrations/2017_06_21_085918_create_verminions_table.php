<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerminionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verminions', function (Blueprint $table) {
            $table->integer('id');
            $table->string('race',100);
            $table->integer('cost');
            $table->integer('hp');
            $table->integer('attack');
            $table->integer('defense');
            $table->integer('speed');
            $table->integer('skill_cost');
            $table->string('skill_type',100);
            $table->string('action_en',100);
            $table->string('action_fr',100);
            $table->string('action_de',100);
            $table->string('action_ja',100);
            $table->tinyInteger('strength_arcana');
            $table->tinyInteger('strength_eye');
            $table->tinyInteger('strength_gate');
            $table->tinyInteger('strength_shield');
            $table->tinyInteger('strength_attack');
            $table->text('help_en');
            $table->text('help_fr');
            $table->text('help_de');
            $table->text('help_ja');
            $table->primary('id');
            $table->foreign('id')->references('id')->on('minions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verminion');
    }
}
