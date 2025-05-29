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
            $table->string('letra', 2);
            $table->integer('numero')->unsigned();
            $table->unsignedBigInteger('cliente');
            $table->unsignedBigInteger('sector');
            $table->unsignedBigInteger('estado');
            $table->timestamps();
            $table->foreign('cliente')->references('id')->on('clientes');
            $table->foreign('sector')->references('id')->on('sectores');
            $table->foreign('estado')->references('id')->on('estados');
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
