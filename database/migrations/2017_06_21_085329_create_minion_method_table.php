<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinionMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minion_method', function (Blueprint $table) {
            $table->integer('minion_id');
            $table->string('method_name',100);
            $table->tinyInteger('available');
            $table->text('description_en');
            $table->text('description_fr');
            $table->text('description_de');
            $table->text('description_ja');
            $table->primary(['minion_id','method_name']);
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
        Schema::dropIfExists('minion_method');
    }
}
