<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historiales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('turno');
            $table->unsignedBigInteger('puesto');
            $table->unsignedBigInteger('estado');
            $table->unsignedBigInteger('der_para')->nullable();
            $table->timestamps();
            $table->foreign('turno')->references('id')->on('turnos');
            $table->foreign('der_para')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historiales');
    }
}
