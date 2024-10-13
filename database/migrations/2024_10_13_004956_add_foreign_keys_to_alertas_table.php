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
        Schema::table('alertas', function (Blueprint $table) {
            $table->foreign(['idUsuario'], 'usuario_alerta')->references(['id'])->on('usuarios');
            $table->foreign(['idTipo'], 'alerta_tipo')->references(['id'])->on('tipoalertas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alertas', function (Blueprint $table) {
            $table->dropForeign('usuario_alerta');
            $table->dropForeign('alerta_tipo');
        });
    }
};
