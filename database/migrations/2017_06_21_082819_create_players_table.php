<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name', 100);
            $table->string('world', 100);
            $table->string('title', 100);
            $table->string('portrait', 250);
            $table->string('race', 50);
            $table->string('clan', 50);
            $table->string('gender', 50);
            $table->string('nameday', 200);
            $table->string('guardian', 100);
            $table->string('grand_company', 100);
            $table->string('free_company_id', 30);
            $table->string('free_company', 100);
            $table->date('last_update_date');
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
