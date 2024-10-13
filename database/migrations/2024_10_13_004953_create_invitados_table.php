<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitados', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('idCliente')->nullable()->index('idCliente');
            $table->string('invitado', 200)->nullable();
            $table->dateTime('fechaRegistro')->nullable();
            $table->integer('idRegistro')->nullable();
            $table->integer('aplicado')->nullable()->comment('0=no aplicado,1=aplicado');
            $table->dateTime('fechaAplicado')->nullable();
            $table->integer('idAplico')->nullable()->index('idAplico');
            $table->integer('idMesAplico')->nullable()->index('idMesAplico');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitados');
    }
};
