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
        Schema::create('pagos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('idCliente')->nullable()->index('clientePago');
            $table->integer('idTipoPago')->nullable()->index('tipoReferencia');
            $table->integer('idReferencia')->nullable()->index('tipoReferencias');
            $table->decimal('importe', 10)->nullable();
            $table->decimal('pendiente', 10)->nullable();
            $table->string('observacion', 250)->nullable();
            $table->integer('idRegistro')->nullable()->index('quienRegistro');
            $table->dateTime('fechaRegistro')->nullable();
            $table->date('fechaInicio')->nullable();
            $table->integer('alertado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
};
