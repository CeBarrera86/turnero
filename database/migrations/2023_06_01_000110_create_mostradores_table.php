<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMostradoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mostradores', function (Blueprint $table) {
            $table->id();
            $table->Integer('numero')->unsigned();
            $table->string('ip', 15)->unique();
            $table->string('alfa',4)->nullable();
            $table->string('tipo',10)->nullable();
            $table->unsignedBigInteger('sector');
            $table->timestamps();
            $table->foreign('sector')->references('id')->on('sectores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mostradores');
    }
}
