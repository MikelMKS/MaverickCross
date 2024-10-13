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
        Schema::table('invitados', function (Blueprint $table) {
            $table->foreign(['idAplico'], 'invitados_ibfk_2')->references(['id'])->on('usuarios');
            $table->foreign(['idCliente'], 'invitados_ibfk_1')->references(['id'])->on('usuarios');
            $table->foreign(['idMesAplico'], 'invitados_ibfk_3')->references(['id'])->on('pagos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invitados', function (Blueprint $table) {
            $table->dropForeign('invitados_ibfk_2');
            $table->dropForeign('invitados_ibfk_1');
            $table->dropForeign('invitados_ibfk_3');
        });
    }
};
