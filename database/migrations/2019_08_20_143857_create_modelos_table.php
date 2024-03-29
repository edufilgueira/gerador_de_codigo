<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateModelosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('projeto_id')->unsigned();
            $table->string('singular');
            $table->string('plural');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('projeto_id')->references('id')->on('projetos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('modelos');
    }
}
