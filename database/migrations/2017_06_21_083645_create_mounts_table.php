<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mounts', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name',100);
            $table->string('icon_url',255);
            $table->string('picture_url',255);
            $table->string('patch',50);
            $table->tinyInteger('can_fly')->default(0);
            $table->string('name_en',100);
            $table->string('name_fr',100);
            $table->string('name_de',100);
            $table->string('name_ja',100);
            $table->text('description_en');
            $table->text('description_fr');
            $table->text('description_de');
            $table->text('description_ja');
            $table->text('summon_en');
            $table->text('summon_fr');
            $table->text('summon_de');
            $table->text('summon_ja');
            $table->string('behavior',100);
            $table->tinyInteger('sellable')->default(0);
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
        Schema::dropIfExists('mounts');
    }
}
