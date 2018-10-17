<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePelisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cines_id')->unsigned();
            $table->timestamps();
            $table->string('nombre');
            $table->string('descripcion');
            $table->softDeletes();
            $table->foreign('cines_id')->references('id')->on('cines')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelis');
    }
}
