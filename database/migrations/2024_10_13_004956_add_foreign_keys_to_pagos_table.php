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
        Schema::table('pagos', function (Blueprint $table) {
            $table->foreign(['idRegistro'], 'quienRegistro')->references(['id'])->on('usuarios');
            $table->foreign(['idReferencia'], 'tipoReferencias')->references(['id'])->on('tipopagos');
            $table->foreign(['idCliente'], 'clientePago')->references(['id'])->on('clientes');
            $table->foreign(['idTipoPago'], 'tipoPago')->references(['id'])->on('tipopagos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pagos', function (Blueprint $table) {
            $table->dropForeign('quienRegistro');
            $table->dropForeign('tipoReferencias');
            $table->dropForeign('clientePago');
            $table->dropForeign('tipoPago');
        });
    }
};
