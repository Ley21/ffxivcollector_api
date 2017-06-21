<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMountMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mount_method', function (Blueprint $table) {
            $table->integer('mount_id');
            $table->string('method_name',100);
            $table->tinyInteger('available');
            $table->text('description_en');
            $table->text('description_fr');
            $table->text('description_de');
            $table->text('description_ja');
            $table->primary(['mount_id','method_name']);
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
        Schema::dropIfExists('mount_method');
    }
}
