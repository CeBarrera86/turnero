<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('alfa', 5);
            $table->unsignedBigInteger('cliente');
            $table->unsignedBigInteger('sector');
	        $table->integer('numero')->unsigned()->nullable();
            $table->boolean('llamado');
            $table->boolean('derivado');
            $table->boolean('eliminado');
            $table->timestamps();
            $table->foreign('cliente')->references('id')->on('clientes');
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
        Schema::dropIfExists('tickets');
    }
}
